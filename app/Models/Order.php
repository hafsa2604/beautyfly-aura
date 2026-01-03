<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_number', 'name', 'email', 'phone', 'address',
        'total_amount', 'delivery_charges', 'status', 'notes', 'payment_method'
    ];

    /**
     * Get the user that placed the order (if logged in)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all items for this order
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Generate a unique order number
     */
    public static function generateOrderNumber(): string
    {
        return 'ORD-' . strtoupper(uniqid());
    }

    /**
     * Get the grand total (subtotal + delivery charges)
     */
    public function getGrandTotalAttribute(): float
    {
        return $this->total_amount + ($this->delivery_charges ?? 0);
    }
}
