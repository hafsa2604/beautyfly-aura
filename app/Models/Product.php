<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'slug', 'type', 'price', 'image', 'desc', 'benefits', 'usage'
    ];

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
}
