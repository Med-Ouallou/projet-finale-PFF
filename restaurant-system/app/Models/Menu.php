<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'description',
        'valid_from',
        'valid_until',
        'is_active',
        'display_order',
        'image_url',
        'currency',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
