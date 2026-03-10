<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = [
        'name',
        'reference',
        'quantity_in_stock',
        'min_threshold',
        'unit',
        'unit_price',
    ];
}
