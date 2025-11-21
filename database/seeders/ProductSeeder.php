<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $items = [
            // Dry Skin
            ['title'=>'Hydrating Serum','type'=>'dry','price'=>1800,'image'=>'serum.jpg','desc'=>'Deep hydration with hyaluronic acid.','benefits'=>'Hydrates and plumps skin.','usage'=>'Apply 2–3 drops after cleansing.'],
            ['title'=>'Gentle Cleanser','type'=>'dry','price'=>1000,'image'=>'cleanser.jpg','desc'=>'Soft cleanser that doesn’t strip moisture.','benefits'=>'Cleans gently without dryness.','usage'=>'Massage on damp skin and rinse.'],
            ['title'=>'Moisture Repair Cream','type'=>'dry','price'=>2000,'image'=>'moisturecream.jpg','desc'=>'Rich cream with ceramides & peptides.','benefits'=>'Repairs and nourishes dry skin.','usage'=>'Apply after serum.'],
            ['title'=>'Alpha Arbutin 2%','type'=>'dry','price'=>2200,'image'=>'alphaarbutin.jpg','desc'=>'Brightens skin tone.','benefits'=>'Fades pigmentation.','usage'=>'Use before moisturizer.'],
            ['title'=>'Niacinamide 5%','type'=>'dry','price'=>2100,'image'=>'niacinamide.jpg','desc'=>'Improves skin barrier & tone.','benefits'=>'Reduces redness.','usage'=>'Use twice daily.'],

            // Oily Skin
            ['title'=>'Oil Control Toner','type'=>'oily','price'=>1400,'image'=>'toner.jpg','desc'=>'Minimizes pores and balances sebum.','benefits'=>'Reduces oil, prevents acne.','usage'=>'Use after cleansing.'],
            ['title'=>'Mattifying Gel','type'=>'oily','price'=>1200,'image'=>'gel.jpg','desc'=>'Keeps your skin shine-free.','benefits'=>'Controls oil all day.','usage'=>'Apply before sunscreen.'],
            ['title'=>'Salicylic Acid 2%','type'=>'oily','price'=>1700,'image'=>'salicylicacid.jpg','desc'=>'Unclogs pores & fights acne.','benefits'=>'Clears acne and texture.','usage'=>'Use at night.'],
            ['title'=>'Niacinamide 10%','type'=>'oily','price'=>1900,'image'=>'niacinamide10.jpg','desc'=>'Controls oil & redness.','benefits'=>'Minimizes pores.','usage'=>'Use 2 drops daily.'],
            ['title'=>'Oil-Free Moisturizer','type'=>'oily','price'=>1500,'image'=>'oilfreemoisturizer.jpg','desc'=>'Hydrates without clogging pores.','benefits'=>'Lightweight hydration.','usage'=>'Apply after serums.'],

            // Combination Skin
            ['title'=>'Balance Moisturizer','type'=>'combination','price'=>1600,'image'=>'balancemoisturizer.jpg','desc'=>'Hydrates dry areas, controls oily zones.','benefits'=>'Balances moisture.','usage'=>'Apply morning and night.'],
            ['title'=>'Gentle Foaming Cleanser','type'=>'combination','price'=>1100,'image'=>'foamcleanser.jpg','desc'=>'Balances oil and hydration.','benefits'=>'Cleans without stripping.','usage'=>'Use daily.'],
            ['title'=>'Lactic Acid 5%','type'=>'combination','price'=>2000,'image'=>'lacticacid.jpg','desc'=>'Gently exfoliates and smooths texture.','benefits'=>'Improves glow.','usage'=>'Use 1–2x weekly.'],
            ['title'=>'Alpha Arbutin + HA','type'=>'combination','price'=>2100,'image'=>'alphaarbutinha.jpg','desc'=>'Brightens uneven tone.','benefits'=>'Boosts brightness.','usage'=>'Use daily before moisturizer.'],
            ['title'=>'Multi-Vitamin Serum','type'=>'combination','price'=>2300,'image'=>'multivitamin.jpg','desc'=>'Boosts glow with vitamins B, C, and E.','benefits'=>'Enhances radiance.','usage'=>'Use in the morning.'],
        ];

        foreach ($items as $item) {
            Product::create(array_merge($item, [
                'slug' => Str::slug($item['title']) . '-' . time()
            ]));
        }
    }
}
