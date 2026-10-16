<?php

namespace Tests\Unit;

use App\Models\Warehouse;
use App\Models\WarehouseBooking;
use App\Services\WarehouseInvoiceCalculator;
use Tests\TestCase;

class WarehouseInvoiceCalculatorTest extends TestCase
{
    public function test_daily_warehouse_price_is_multiplied_by_capacity_and_inclusive_booking_days(): void
    {
        config()->set('services.tax.rate', 5);
        $booking = new WarehouseBooking([
            'start_date' => '2025-05-01',
            'end_date' => '2025-05-03',
            'requested_capacity' => 2.5,
        ]);
        $warehouse = new Warehouse([
            'price_value' => 4.50,
            'price_unit' => 'CAD/Chargeable Unit/Day',
        ]);

        $result = app(WarehouseInvoiceCalculator::class)->calculate($booking, $warehouse);

        $this->assertSame('CAD', $result['currency']);
        $this->assertSame(3375, $result['subtotal_cents']);
        $this->assertSame(169, $result['tax_cents']);
        $this->assertSame(3544, $result['total_cents']);
    }

    public function test_monthly_price_is_prorated_per_calendar_month(): void
    {
        config()->set('services.tax.rate', 5);
        $booking = new WarehouseBooking([
            'start_date' => '2025-01-15',
            'end_date' => '2025-02-14',
            'requested_capacity' => 2,
        ]);
        $warehouse = new Warehouse([
            'price_value' => 31,
            'price_unit' => 'USD/Chargeable Unit/Month',
        ]);

        $result = app(WarehouseInvoiceCalculator::class)->calculate($booking, $warehouse);

        $this->assertSame('USD', $result['currency']);
        $this->assertSame(6500, $result['subtotal_cents']);
        $this->assertSame(325, $result['tax_cents']);
        $this->assertSame(6825, $result['total_cents']);
    }
}
