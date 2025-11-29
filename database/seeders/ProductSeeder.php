<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Get categories
        $dryCategory = Category::where('slug', 'dry-skin')->first();
        $oilyCategory = Category::where('slug', 'oily-skin')->first();
        $combinationCategory = Category::where('slug', 'combination-skin')->first();

        $items = [
            // Dry Skin
            ['title'=>'Hydrating Serum','category'=>$dryCategory,'price'=>1800,'image'=>'serum.jpg','desc'=>'Deep hydration with hyaluronic acid.','benefits'=>'Hydrates and plumps skin.','usage'=>'Apply 2–3 drops after cleansing.'],
            ['title'=>'Gentle Cleanser','category'=>$dryCategory,'price'=>1000,'image'=>'cleanser.jpg','desc'=>'Soft cleanser that does not strip moisture.','benefits'=>'Cleans gently without dryness.','usage'=>'Massage on damp skin and rinse.'],
            ['title'=>'Moisture Repair Cream','category'=>$dryCategory,'price'=>2000,'image'=>'moisturecream.jpg','desc'=>'Rich cream with ceramides & peptides.','benefits'=>'Repairs and nourishes dry skin.','usage'=>'Apply after serum.'],
            ['title'=>'Alpha Arbutin 2%','category'=>$dryCategory,'price'=>2200,'image'=>'alphaarbutin.jpg','desc'=>'Brightens skin tone.','benefits'=>'Fades pigmentation.','usage'=>'Use before moisturizer.'],
            ['title'=>'Niacinamide 5%','category'=>$dryCategory,'price'=>2100,'image'=>'niacinamide.jpg','desc'=>'Improves skin barrier & tone.','benefits'=>'Reduces redness.','usage'=>'Use twice daily.'],

            // Oily Skin
            ['title'=>'Oil Control Toner','category'=>$oilyCategory,'price'=>1400,'image'=>'toner.jpg','desc'=>'Minimizes pores and balances sebum.','benefits'=>'Reduces oil, prevents acne.','usage'=>'Use after cleansing.'],
            ['title'=>'Mattifying Gel','category'=>$oilyCategory,'price'=>1200,'image'=>'gel.jpg','desc'=>'Keeps your skin shine-free.','benefits'=>'Controls oil all day.','usage'=>'Apply before sunscreen.'],
            ['title'=>'Salicylic Acid 2%','category'=>$oilyCategory,'price'=>1700,'image'=>'salicylicacid.jpg','desc'=>'Unclogs pores & fights acne.','benefits'=>'Clears acne and texture.','usage'=>'Use at night.'],
            ['title'=>'Niacinamide 10%','category'=>$oilyCategory,'price'=>1900,'image'=>'niacinamide10.jpg','desc'=>'Controls oil & redness.','benefits'=>'Minimizes pores.','usage'=>'Use 2 drops daily.'],
            ['title'=>'Oil-Free Moisturizer','category'=>$oilyCategory,'price'=>1500,'image'=>'oilfreemoisturizer.jpg','desc'=>'Hydrates without clogging pores.','benefits'=>'Lightweight hydration.','usage'=>'Apply after serums.'],

            // Combination Skin
            ['title'=>'Balance Moisturizer','category'=>$combinationCategory,'price'=>1600,'image'=>'balancemoisturizer.jpg','desc'=>'Hydrates dry areas, controls oily zones.','benefits'=>'Balances moisture.','usage'=>'Apply morning and night.'],
            ['title'=>'Gentle Foaming Cleanser','category'=>$combinationCategory,'price'=>1100,'image'=>'foamcleanser.jpg','desc'=>'Balances oil and hydration.','benefits'=>'Cleans without stripping.','usage'=>'Use daily.'],
            ['title'=>'Lactic Acid 5%','category'=>$combinationCategory,'price'=>2000,'image'=>'lacticacid.jpg','desc'=>'Gently exfoliates and smooths texture.','benefits'=>'Improves glow.','usage'=>'Use 1–2x weekly.'],
            ['title'=>'Alpha Arbutin + HA','category'=>$combinationCategory,'price'=>2100,'image'=>'alphaarbutinha.jpg','desc'=>'Brightens uneven tone.','benefits'=>'Boosts brightness.','usage'=>'Use daily before moisturizer.'],
            ['title'=>'Multi-Vitamin Serum','category'=>$combinationCategory,'price'=>2300,'image'=>'multivitamin.jpg','desc'=>'Boosts glow with vitamins B, C, and E.','benefits'=>'Enhances radiance.','usage'=>'Use in the morning.'],
        ];

        foreach ($items as $item) {
            $category = $item['category'];
            unset($item['category']);
            
            // Use updateOrCreate to prevent duplicates
            Product::updateOrCreate(
                ['title' => $item['title']], // Find by title
                array_merge($item, [
                    'category_id' => $category->id,
                    'slug' => Str::slug($item['title']) . '-' . time()
                ])
            );
        }
    }
}
