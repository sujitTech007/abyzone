<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WarehouseBookingEvent extends Model
{
    protected $fillable = [
        'warehouse_booking_id',
        'event_type',
        'from_status',
        'to_status',
        'actor_id',
        'actor_role',
        'message',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(WarehouseBooking::class, 'warehouse_booking_id');
    }

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id');
    }
}
