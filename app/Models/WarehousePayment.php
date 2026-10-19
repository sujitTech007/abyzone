<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WarehousePayment extends Model
{
    protected $guarded = [];

    protected $casts = [
        'invoice_snapshot' => 'array',
        'tax_rate' => 'decimal:4',
        'commission_percent' => 'decimal:2',
        'paid_at' => 'datetime',
        'refunded_at' => 'datetime',
        'commission_set_at' => 'datetime',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(WarehouseBooking::class, 'warehouse_booking_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(WarehousePaymentEvent::class);
    }
}
