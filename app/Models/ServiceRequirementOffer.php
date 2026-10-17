<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequirementOffer extends Model
{
    protected $fillable = [
        'service_requirement_id',
        'channel_partner_id',
        'amount',
        'description',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function requirement(): BelongsTo
    {
        return $this->belongsTo(ServiceRequirement::class, 'service_requirement_id');
    }

    public function channelPartner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'channel_partner_id');
    }
}
