<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'code',
        'discount_percentage',
        'discount_amount',
        'valid_from',
        'valid_until',
        'usage_limit',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
