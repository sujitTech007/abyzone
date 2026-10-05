<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    protected $fillable = [
        'name', 'email', 'phone',
        'industry_type', 'business_size', 'space_needed',
        'warehouse_location', 'estimated', 'need_warehouse',
    ];
}