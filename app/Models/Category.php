<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
      protected $table = 'categories';
    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
