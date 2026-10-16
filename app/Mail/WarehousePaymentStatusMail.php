<?php

namespace App\Mail;

use App\Models\WarehousePayment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WarehousePaymentStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public WarehousePayment $payment,
        public string $eventType
    ) {
    }

    public function build(): self
    {
        $subject = match ($this->eventType) {
            'payment_confirmed' => "Payment confirmed | ABYzone {$this->payment->invoice_number}",
            'refund_initiated' => "Refund requested | ABYzone {$this->payment->invoice_number}",
            'refund_confirmed' => "Refund confirmed | ABYzone {$this->payment->invoice_number}",
            'refund_failed' => "Refund update | ABYzone {$this->payment->invoice_number}",
            default => "Payment update | ABYzone {$this->payment->invoice_number}",
        };

        return $this->subject($subject)
            ->view('emails.warehouse-payment-status', [
                'payment' => $this->payment,
                'eventType' => $this->eventType,
                'invoiceUrl' => route('user.warehouse-payments.show', $this->payment),
            ]);
    }
}
