<?php

namespace App\Services;

use App\Models\Warehouse;
use App\Models\WarehouseBooking;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class WarehouseInvoiceCalculator
{
    public function calculate(WarehouseBooking $booking, Warehouse $warehouse): array
    {
        if (! $booking->start_date || ! $booking->requested_capacity || $booking->requested_capacity <= 0) {
            throw ValidationException::withMessages([
                'status' => 'Add booking dates and a requested capacity before approving this booking so its invoice can be calculated.',
            ]);
        }

        if (! $warehouse->price_value || $warehouse->price_value <= 0 || ! $warehouse->price_unit) {
            throw ValidationException::withMessages([
                'status' => 'Set a warehouse price before approving this booking so its invoice can be calculated.',
            ]);
        }

        if (! preg_match('/^(CAD|USD)\/Chargeable Unit\/(Day|Month)$/i', $warehouse->price_unit, $matches)) {
            throw ValidationException::withMessages([
                'status' => 'The warehouse price unit must be CAD or USD per chargeable unit per day or month.',
            ]);
        }

        $taxRate = config('services.tax.rate');
        if (! is_numeric($taxRate) || (float) $taxRate < 0 || (float) $taxRate > 100) {
            throw new \RuntimeException('TAX_RATE must be a number between 0 and 100.');
        }

        $start = Carbon::parse($booking->start_date)->startOfDay();
        $end = $booking->end_date
            ? Carbon::parse($booking->end_date)->startOfDay()
            : $start->copy();
        if ($end->lt($start)) {
            throw ValidationException::withMessages([
                'status' => 'The booking end date must be on or after its start date before an invoice can be issued.',
            ]);
        }

        $priceCents = (int) round((float) $warehouse->price_value * 100);
        $capacity = (float) $booking->requested_capacity;
        $days = (int) $start->diffInDays($end) + 1;
        $billingUnit = strtolower($matches[2]);

        if ($billingUnit === 'day') {
            $subtotalCents = (int) round($priceCents * $capacity * $days);
        } else {
            $subtotalCents = 0;
            $month = $start->copy()->startOfMonth();

            while ($month->lte($end)) {
                $periodStart = $start->gt($month) ? $start : $month;
                $periodEnd = $end->lt($month->copy()->endOfMonth()) ? $end : $month->copy()->endOfMonth();
                $periodDays = (int) $periodStart->diffInDays($periodEnd) + 1;
                $subtotalCents += (int) round(
                    $priceCents * $capacity * $periodDays / $month->daysInMonth
                );
                $month->addMonthNoOverflow()->startOfMonth();
            }
        }

        if ($subtotalCents < 1) {
            throw ValidationException::withMessages([
                'status' => 'The calculated booking price must be at least one cent before the booking can be approved.',
            ]);
        }

        $taxRate = round((float) $taxRate, 4);
        $taxCents = (int) round($subtotalCents * $taxRate / 100);

        return [
            'currency' => strtoupper($matches[1]),
            'subtotal_cents' => $subtotalCents,
            'tax_rate' => $taxRate,
            'tax_cents' => $taxCents,
            'total_cents' => $subtotalCents + $taxCents,
            'days' => $days,
            'billing_unit' => $billingUnit,
            'unit_price_cents' => $priceCents,
        ];
    }
}
