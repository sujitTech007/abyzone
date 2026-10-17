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
        'service_type',
        'title',
        'description',
        'service_location',
        'needed_by',
        'status',
    ];

    protected $casts = [
        'needed_by' => 'date',
    ];

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(ServiceRequirementOffer::class);
    }
}
