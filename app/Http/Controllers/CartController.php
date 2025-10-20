<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    private function getProducts()
    {
        return [
            1 => ['id'=>1,'title'=>'Hydrating Serum','price'=>1800,'image'=>'serum.jpg'],
            2 => ['id'=>2,'title'=>'Mattifying Moisturizer','price'=>1500,'image'=>'moisturizer.jpg'],
            3 => ['id'=>3,'title'=>'Balance Cleanser','price'=>900,'image'=>'cleanser.jpg'],
            4 => ['id'=>4,'title'=>'SPF Glow','price'=>1200,'image'=>'spf.jpg'],
        ];
    }

    public function view()
    {
        $cart = session('cart', []);
        return view('pages.cart', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $products = $this->getProducts();
        if(!isset($products[$id])) abort(404);

        $cart = session('cart', []);
        if(isset($cart[$id])) $cart[$id]['quantity'] += 1;
        else $cart[$id] = ['product'=> $products[$id], 'quantity'=>1];

        session(['cart' => $cart]);
        return redirect()->route('cart.view')->with('success', 'Product added to cart.');
    }

    public function update(Request $request, $id)
    {
        $cart = session('cart', []);
        if(isset($cart[$id])) {
            $qty = max(1, intval($request->input('quantity',1)));
            $cart[$id]['quantity'] = $qty;
            session(['cart' => $cart]);
        }
        return redirect()->route('cart.view');
    }

    public function remove(Request $request, $id)
    {
        $cart = session('cart', []);
        if(isset($cart[$id])) unset($cart[$id]);
        session(['cart' => $cart]);
        return redirect()->route('cart.view');
    }
}
