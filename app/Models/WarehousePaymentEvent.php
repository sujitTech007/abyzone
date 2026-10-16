<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WarehousePaymentEvent extends Model
{
    protected $guarded = [];

    protected $casts = [
        'metadata' => 'array',
        'notification_sent_at' => 'datetime',
    ];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(WarehousePayment::class, 'warehouse_payment_id');
    }
}
