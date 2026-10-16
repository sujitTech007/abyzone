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
        $subject = match ($this->status) {
            'approved' => "Booking confirmed | ABYzone #{$this->booking->id}",
            'declined' => "Booking request update | ABYzone #{$this->booking->id}",
            'meeting_scheduled' => "Meeting details | ABYzone #{$this->booking->id}",
            'cancelled' => "Booking cancelled | ABYzone #{$this->booking->id}",
            default => "Booking status update | ABYzone #{$this->booking->id}",
        };

        return $this->subject($subject)
            ->view('emails.booking-status');
    }
}
