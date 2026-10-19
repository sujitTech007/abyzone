<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerReview extends Model
{
    protected $fillable = [
        'author_id',
        'target_user_id',
        'warehouse_booking_id',
        'service_requirement_id',
        'rating',
        'comment',
        'status',
        'moderation_note',
        'moderated_by',
        'moderated_at',
    ];

    protected $casts = [
        'moderated_at' => 'datetime',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function target(): BelongsTo
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }

    public function warehouseBooking(): BelongsTo
    {
        return $this->belongsTo(WarehouseBooking::class);
    }

    public function serviceRequirement(): BelongsTo
    {
        return $this->belongsTo(ServiceRequirement::class);
    }
}
