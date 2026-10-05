<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingRequest extends Model
{
    protected $fillable = [
        'full_name', 'email', 'phone', 'preferred_date', 'message'
    ];
}
