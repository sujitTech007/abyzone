<?php

namespace Tests\Unit;

use App\Models\WarehousePayment;
use Barryvdh\DomPDF\Facade\Pdf;
use Tests\TestCase;

class WarehouseInvoicePdfTest extends TestCase
{
    public function test_warehouse_invoice_view_generates_a_pdf(): void
    {
        $payment = new WarehousePayment([
            'invoice_number' => 'WHI-2026-00000001',
            'status' => 'invoice_due',
            'currency' => 'CAD',
            'subtotal_cents' => 10000,
            'tax_rate' => 5,
            'tax_cents' => 500,
            'total_cents' => 10500,
            'invoice_snapshot' => [
                'invoice_number' => 'WHI-2026-00000001',
                'booking_id' => 1,
                'warehouse_name' => 'Test warehouse',
                'warehouse_address' => '1 Example Street',
                'customer_name' => 'Test Customer',
                'customer_email' => 'customer@example.test',
                'vendor_name' => 'Test Vendor',
                'vendor_email' => 'vendor@example.test',
                'start_date' => '2026-10-20',
                'end_date' => '2026-10-21',
                'requested_capacity' => 2,
                'requested_capacity_unit' => 'Pallet',
                'price_unit' => 'CAD/Chargeable Unit/Day',
                'days' => 2,
            ],
        ]);
        $payment->created_at = now();

        $contents = Pdf::loadView('invoices.warehouse-booking', [
            'payment' => $payment,
            'snapshot' => $payment->invoice_snapshot,
        ])->output();

        $this->assertStringStartsWith('%PDF-', $contents);
    }
}
