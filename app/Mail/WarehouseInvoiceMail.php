<?php

namespace App\Mail;

use App\Models\WarehousePayment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WarehouseInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public WarehousePayment $payment)
    {
    }

    public function build(): self
    {
        $payment = $this->payment->loadMissing('booking');
        $snapshot = $payment->invoice_snapshot;
        $pdf = Pdf::loadView('invoices.warehouse-booking', compact('payment', 'snapshot'));

        return $this->subject("Warehouse booking invoice {$payment->invoice_number} | ABYzone")
            ->view('emails.warehouse-invoice')
            ->with([
                'payment' => $payment,
                'invoiceUrl' => route('user.warehouse-payments.show', $payment),
            ])
            ->attachData($pdf->output(), $payment->invoice_number . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
