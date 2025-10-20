<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    private function getProducts()
    {
        return [
            1 => ['id'=>1,'title'=>'Hydrating Serum','short'=>'Lightweight serum for dry skin','price'=>1800,'image'=>'serum.jpg','type'=>'Dry'],
            2 => ['id'=>2,'title'=>'Mattifying Moisturizer','short'=>'Controls oil for oily skin','price'=>1500,'image'=>'moisturizer.jpg','type'=>'Oily'],
            3 => ['id'=>3,'title'=>'Balance Cleanser','short'=>'Gentle for combination skin','price'=>900,'image'=>'cleanser.jpg','type'=>'Combination'],
            4 => ['id'=>4,'title'=>'SPF Glow','short'=>'Daily SPF for all skin types','price'=>1200,'image'=>'spf.jpg','type'=>'All']
        ];
    }

    public function index(Request $request)
    {
        $products = $this->getProducts();

        // Simple search
        if($request->has('search') && $request->search != '') {
            $q = strtolower($request->search);
            $products = array_filter($products, function($p) use ($q) {
                return strpos(strtolower($p['title']), $q) !== false;
            });
        }

        // Filter by skin type
        if($request->has('skin_type') && $request->skin_type != '' && $request->skin_type != 'All') {
            $products = array_filter($products, function($p) use ($request) {
                return $p['type'] === $request->skin_type;
            });
        }

        return view('pages.products', ['products' => $products, 'request' => $request]);
    }

    public function show($id)
    {
        $products = $this->getProducts();
        if(!isset($products[$id])) abort(404);
        $product = $products[$id];
        $reviews = session("reviews.$id", []);
        return view('pages.product-details', compact('product','reviews'));
    }

    public function addReview(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'review' => 'required|string|max:500',
        ]);

        $reviews = session("reviews.$id", []);
        $reviews[] = $validated;
        session(["reviews.$id" => $reviews]);

        return redirect()->route('product.show', $id)->with('success', 'Thank you for your review!');
    }
}
