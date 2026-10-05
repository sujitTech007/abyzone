<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\WarehouseBooking;

class BookingStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct(WarehouseBooking $booking, string $status)
    {
        $this->booking = $booking;
        $this->status = $status;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = "Your booking request has been {$this->status}";
        return $this->subject($subject)
                    ->view('emails.booking-status');
    }
}
