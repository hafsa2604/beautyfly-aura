<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'title', 'slug', 'category_id', 'price', 'image', 'desc', 'benefits', 'usage'
    ];

    /**
     * Get the category that owns the product
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all reviews for this product
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the product image URL with fallback
     */
    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('images/placeholder.jpg');
        }

        $imagePath = public_path('images/' . $this->image);
        
        if (file_exists($imagePath)) {
            return asset('images/' . $this->image);
        }

        return asset('images/placeholder.jpg');
    }

    /**
     * Get type attribute for backward compatibility (returns category name)
     */
    public function getTypeAttribute()
    {
        return $this->category ? strtolower($this->category->slug) : null;
    }
}
