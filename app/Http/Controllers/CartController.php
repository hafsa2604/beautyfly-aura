<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;

class CartController extends Controller
{
    public function view()
    {
        $cart = session('cart', []);
        return view('pages.cart', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $products = (new ProductController())->getAllProducts();
        if (!isset($products[$id])) abort(404);

        $product = $products[$id];
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = ['product' => $product, 'quantity' => 1];
        }

        session(['cart' => $cart]);
        return redirect()->route('cart.view')->with('success', 'Product added to cart.');
    }

    public function update(Request $request, $id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, intval($request->input('quantity', 1)));
            session(['cart' => $cart]);
        }
        return redirect()->route('cart.view');
    }

    public function remove($id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) unset($cart[$id]);
        session(['cart' => $cart]);
        return redirect()->route('cart.view');
    }
}

