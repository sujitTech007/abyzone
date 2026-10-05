<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\WarehouseBooking;

class BookingRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     */
    public function __construct(WarehouseBooking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = "New warehouse booking request: {$this->booking->warehouse->name}";
        return $this->subject($subject)
                    ->view('emails.booking-request');
    }
}
