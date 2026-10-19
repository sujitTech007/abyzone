<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequirementPayment extends Model
{
    protected $guarded = [];

    protected $casts = [
        'amount_cents' => 'integer',
        'commission_percent' => 'decimal:2',
        'commission_cents' => 'integer',
        'partner_net_cents' => 'integer',
        'paid_at' => 'datetime',
        'commission_set_at' => 'datetime',
    ];

    public function requirement(): BelongsTo
    {
        return $this->belongsTo(ServiceRequirement::class, 'service_requirement_id');
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(ServiceRequirementOffer::class, 'service_requirement_offer_id');
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function channelPartner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'channel_partner_id');
    }
}
