<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Use the Product model directly

class CartController extends Controller
{
    // View the cart
    public function view()
    {
        $cart = session('cart', []);
        return view('pages.cart', compact('cart'));
    }

    // Add product to cart
    public function add(Request $request, $id)
    {
        $product = Product::find($id); // Fetch product by ID
        if (!$product) {
            abort(404, 'Product not found');
        }

        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'product' => $product,
                'quantity' => 1
            ];
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.view')->with('success', 'Product added to cart.');
    }

    // Update quantity of a product in the cart
    public function update(Request $request, $id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $quantity = intval($request->input('quantity', 1));
            $cart[$id]['quantity'] = max(1, $quantity); // Minimum 1
            session(['cart' => $cart]);
        }

        return redirect()->route('cart.view')->with('success', 'Cart updated.');
    }

    // Remove a product from the cart
    public function remove($id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        return redirect()->route('cart.view')->with('success', 'Product removed from cart.');
    }
}
