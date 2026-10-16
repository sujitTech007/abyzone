<?php

namespace App\Mail;

use App\Models\Warehouse;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewWarehouseMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Warehouse $warehouse)
    {
    }

    public function build(): self
    {
        return $this->subject('New warehouse available: '.$this->warehouse->name)
            ->view('emails.new-warehouse');
    }
}
