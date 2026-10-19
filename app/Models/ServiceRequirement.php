<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceRequirement extends Model
{
    protected $fillable = [
        'requester_id',
        'requester_role',
        'warehouse_id',
        'service_type',
        'title',
        'description',
        'service_location',
        'needed_by',
        'status',
        'partner_completed_at',
        'requester_completed_at',
        'service_completed_at',
    ];

    protected $casts = [
        'needed_by' => 'date',
        'partner_completed_at' => 'datetime',
        'requester_completed_at' => 'datetime',
        'service_completed_at' => 'datetime',
    ];

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(ServiceRequirementOffer::class);
    }

    public function customerReviews(): HasMany
    {
        return $this->hasMany(CustomerReview::class);
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ServiceRequirementPayment::class);
    }
}
