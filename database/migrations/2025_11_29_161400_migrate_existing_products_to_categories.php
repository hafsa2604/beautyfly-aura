<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, ensure categories exist
        $dryCategory = Category::firstOrCreate(
            ['slug' => 'dry-skin'],
            ['name' => 'Dry Skin', 'description' => 'Products specifically formulated for dry skin types']
        );

        $oilyCategory = Category::firstOrCreate(
            ['slug' => 'oily-skin'],
            ['name' => 'Oily Skin', 'description' => 'Products designed to control oil and manage oily skin']
        );

        $combinationCategory = Category::firstOrCreate(
            ['slug' => 'combination-skin'],
            ['name' => 'Combination Skin', 'description' => 'Products that balance both dry and oily areas']
        );

        // Update existing products based on their type field
        Product::where('type', 'dry')->whereNull('category_id')->update(['category_id' => $dryCategory->id]);
        Product::where('type', 'oily')->whereNull('category_id')->update(['category_id' => $oilyCategory->id]);
        Product::where('type', 'combination')->whereNull('category_id')->update(['category_id' => $combinationCategory->id]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Set category_id to null for products
        Product::whereNotNull('category_id')->update(['category_id' => null]);
    }
};
