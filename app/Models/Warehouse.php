<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'amenities' => 'array',
        'infra_amenities' => 'array',
        'images' => 'array',
        'size_sqft' => 'decimal:2',
        'capacity_quantity' => 'decimal:2',
        'price_per_month' => 'decimal:2',
        'price_value' => 'decimal:2',
        'available_from' => 'date',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(WarehouseBooking::class);
    }
}
