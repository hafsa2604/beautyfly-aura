<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page
     */
    public function index()
    {
        return view('pages.checkout'); // ✅ Loads resources/views/checkout.blade.php
    }

    /**
     * Handle checkout form submission
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // (Later) Save to DB or send order email, etc.

        return redirect()
            ->route('checkout.index')
            ->with('success', 'Order placed successfully! Thank you for shopping with us.');
    }
}
