<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'address',
    ];

    /**
     * Get the user that owns the customer profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the orders for the customer.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the customer's name through the user relationship.
     */
    public function getNameAttribute(): ?string
    {
        return $this->user?->name;
    }

    /**
     * Get the customer's email through the user relationship.
     */
    public function getEmailAttribute(): ?string
    {
        return $this->user?->email;
    }
}
