<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // ✅ Full product catalog
    public function getAllProducts()
    {
        return [
            // Dry Skin
            1 => ['id'=>1,'title'=>'Hydrating Serum','type'=>'dry','price'=>1800,'image'=>'serum.jpg','desc'=>'Deep hydration with hyaluronic acid.','benefits'=>'Hydrates and plumps skin.','usage'=>'Apply 2–3 drops after cleansing.'],
            2 => ['id'=>2,'title'=>'Gentle Cleanser','type'=>'dry','price'=>1000,'image'=>'cleanser.jpg','desc'=>'Soft cleanser that doesn’t strip moisture.','benefits'=>'Cleans gently without dryness.','usage'=>'Massage on damp skin and rinse.'],
            3 => ['id'=>3,'title'=>'Moisture Repair Cream','type'=>'dry','price'=>2000,'image'=>'moisturecream.jpg','desc'=>'Rich cream with ceramides & peptides.','benefits'=>'Repairs and nourishes dry skin.','usage'=>'Apply after serum.'],
            4 => ['id'=>4,'title'=>'Alpha Arbutin 2%','type'=>'dry','price'=>2200,'image'=>'alphaarbutin.jpg','desc'=>'Brightens skin tone.','benefits'=>'Fades pigmentation.','usage'=>'Use before moisturizer.'],
            5 => ['id'=>5,'title'=>'Niacinamide 5%','type'=>'dry','price'=>2100,'image'=>'niacinamide.jpg','desc'=>'Improves skin barrier & tone.','benefits'=>'Reduces redness.','usage'=>'Use twice daily.'],

            // Oily Skin
            6 => ['id'=>6,'title'=>'Oil Control Toner','type'=>'oily','price'=>1400,'image'=>'toner.jpg','desc'=>'Minimizes pores and balances sebum.','benefits'=>'Reduces oil, prevents acne.','usage'=>'Use after cleansing.'],
            7 => ['id'=>7,'title'=>'Mattifying Gel','type'=>'oily','price'=>1200,'image'=>'gel.jpg','desc'=>'Keeps your skin shine-free.','benefits'=>'Controls oil all day.','usage'=>'Apply before sunscreen.'],
            8 => ['id'=>8,'title'=>'Salicylic Acid 2%','type'=>'oily','price'=>1700,'image'=>'salicylicacid.jpg','desc'=>'Unclogs pores & fights acne.','benefits'=>'Clears acne and texture.','usage'=>'Use at night.'],
            9 => ['id'=>9,'title'=>'Niacinamide 10%','type'=>'oily','price'=>1900,'image'=>'niacinamide10.jpg','desc'=>'Controls oil & redness.','benefits'=>'Minimizes pores.','usage'=>'Use 2 drops daily.'],
            10 => ['id'=>10,'title'=>'Oil-Free Moisturizer','type'=>'oily','price'=>1500,'image'=>'oilfreemoisturizer.jpg','desc'=>'Hydrates without clogging pores.','benefits'=>'Lightweight hydration.','usage'=>'Apply after serums.'],

            // Combination Skin
            11 => ['id'=>11,'title'=>'Balance Moisturizer','type'=>'combination','price'=>1600,'image'=>'balancemoisturizer.jpg','desc'=>'Hydrates dry areas, controls oily zones.','benefits'=>'Balances moisture.','usage'=>'Apply morning and night.'],
            12 => ['id'=>12,'title'=>'Gentle Foaming Cleanser','type'=>'combination','price'=>1100,'image'=>'foamcleanser.jpg','desc'=>'Balances oil and hydration.','benefits'=>'Cleans without stripping.','usage'=>'Use daily.'],
            13 => ['id'=>13,'title'=>'Lactic Acid 5%','type'=>'combination','price'=>2000,'image'=>'lacticacid.jpg','desc'=>'Gently exfoliates and smooths texture.','benefits'=>'Improves glow.','usage'=>'Use 1–2x weekly.'],
            14 => ['id'=>14,'title'=>'Alpha Arbutin + HA','type'=>'combination','price'=>2100,'image'=>'alphaarbutinha.jpg','desc'=>'Brightens uneven tone.','benefits'=>'Boosts brightness.','usage'=>'Use daily before moisturizer.'],
            15 => ['id'=>15,'title'=>'Multi-Vitamin Serum','type'=>'combination','price'=>2300,'image'=>'multivitamin.jpg','desc'=>'Boosts glow with vitamins B, C, and E.','benefits'=>'Enhances radiance.','usage'=>'Use in the morning.'],
        ];
    }

    public function index(Request $request)
    {
        $products = $this->getAllProducts();
        $type = $request->query('type');
        if ($type && $type !== 'all') {
            $products = array_filter($products, fn($p) => $p['type'] === $type);
        }

        return view('pages.products', compact('products'));
    }

    public function show($id)
    {
        $products = $this->getAllProducts();
        if (!isset($products[$id])) abort(404);

        $product = $products[$id];
        $reviews = [
            ['name' => 'Sara', 'review' => 'Amazing product, my skin feels soft!'],
            ['name' => 'Ali', 'review' => 'Helped reduce oil and acne. Recommended!'],
        ];

        return view('pages.product-details', compact('product', 'reviews'));
    }

    public function addReview(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'review' => 'required|string|max:500',
        ]);

        return redirect()->route('product.show', $id)
            ->with('success', 'Thank you for your review!');
    }
}

