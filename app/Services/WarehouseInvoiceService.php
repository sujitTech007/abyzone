<?php

namespace App\Services;

use App\Models\WarehouseBooking;
use App\Models\WarehousePayment;
use App\Models\WarehousePaymentEvent;
use Illuminate\Support\Facades\DB;

class WarehouseInvoiceService
{
    public function __construct(private WarehouseInvoiceCalculator $calculator)
    {
    }

    public function issue(WarehouseBooking $booking, int $actorId, string $actorRole): WarehousePayment
    {
        return DB::transaction(function () use ($booking, $actorId, $actorRole) {
            $booking = WarehouseBooking::query()
                ->with(['warehouse', 'customer', 'owner'])
                ->whereKey($booking->id)
                ->lockForUpdate()
                ->firstOrFail();

            $existingPayment = WarehousePayment::where('warehouse_booking_id', $booking->id)->first();
            if ($existingPayment) {
                return $existingPayment;
            }

            $warehouse = $booking->warehouse;
            $customer = $booking->customer;
            if (! $warehouse || ! $customer) {
                throw new \RuntimeException('The booking must have a warehouse and customer before invoicing.');
            }

            $amounts = $this->calculator->calculate($booking, $warehouse);
            $bookingEnd = $booking->end_date ?? $booking->start_date;
            $rateUnit = $warehouse->price_unit;
            $snapshot = [
                'invoice_number' => 'WHI-' . now()->format('Y') . '-' . str_pad((string) $booking->id, 8, '0', STR_PAD_LEFT),
                'booking_id' => $booking->id,
                'warehouse_name' => $warehouse->name,
                'warehouse_address' => implode(', ', array_filter([
                    $warehouse->address_street ?? null,
                    $warehouse->address_city ?? null,
                    $warehouse->address_state ?? null,
                    $warehouse->address_country ?? null,
                    $warehouse->address_postal ?? null,
                    $warehouse->location ?? null,
                ])),
                'customer_name' => $customer->name,
                'customer_email' => $customer->email,
                'vendor_name' => $booking->owner?->business_name ?: $booking->owner?->name,
                'vendor_email' => $booking->owner?->email,
                'start_date' => $booking->start_date->toDateString(),
                'end_date' => $bookingEnd->toDateString(),
                'requested_capacity' => $booking->requested_capacity,
                'requested_capacity_unit' => $booking->requested_capacity_unit,
                'price_unit' => $rateUnit,
                'unit_price_cents' => $amounts['unit_price_cents'],
                'billing_unit' => $amounts['billing_unit'],
                'days' => $amounts['days'],
                'subtotal_cents' => $amounts['subtotal_cents'],
                'tax_rate' => $amounts['tax_rate'],
                'tax_cents' => $amounts['tax_cents'],
                'total_cents' => $amounts['total_cents'],
                'currency' => $amounts['currency'],
            ];

            $payment = WarehousePayment::create([
                'warehouse_booking_id' => $booking->id,
                'invoice_number' => $snapshot['invoice_number'],
                'status' => 'invoice_due',
                'currency' => $amounts['currency'],
                'subtotal_cents' => $amounts['subtotal_cents'],
                'tax_rate' => $amounts['tax_rate'],
                'tax_cents' => $amounts['tax_cents'],
                'total_cents' => $amounts['total_cents'],
                'invoice_snapshot' => $snapshot,
            ]);

            WarehousePaymentEvent::create([
                'warehouse_payment_id' => $payment->id,
                'event_type' => 'invoice_issued',
                'status' => $payment->status,
                'amount_cents' => $payment->total_cents,
                'currency' => $payment->currency,
                'message' => 'Invoice generated when the booking was approved.',
                'metadata' => ['actor_id' => $actorId, 'actor_role' => $actorRole],
                'notification_sent_at' => now(),
            ]);

            return $payment;
        });
    }
}
