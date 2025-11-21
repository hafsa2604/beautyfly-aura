<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'slug', 'type', 'price', 'image', 'desc', 'benefits', 'usage'
    ];
}
