<?php

namespace App\Mail;

use App\Models\WarehouseBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingCancellationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public WarehouseBooking $booking,
        public string $cancelledBy
    ) {
    }

    public function build(): static
    {
        return $this->subject("Booking cancelled | ABYzone #{$this->booking->id}")
            ->view('emails.booking-cancellation');
    }
}
