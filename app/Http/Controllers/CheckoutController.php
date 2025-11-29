<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page
     */
    public function index()
    {
        $cart = session('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.view')
                ->with('error', 'Your cart is empty. Please add products before checkout.');
        }

        return view('pages.checkout', compact('cart'));
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
            'notes' => 'nullable|string|max:500',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')
                ->with('error', 'Your cart is empty.');
        }

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['product']->price * $item['quantity'];
        }

        // Calculate delivery charges (200 PKR if order is below 2000)
        $deliveryCharges = $subtotal < 2000 ? 200 : 0;
        $totalAmount = $subtotal + $deliveryCharges;

        DB::beginTransaction();
        try {
            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => Order::generateOrderNumber(),
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'total_amount' => $subtotal, // Store subtotal
                'delivery_charges' => $deliveryCharges,
                'status' => 'pending',
                'notes' => $validated['notes'] ?? null,
            ]);

            // Create order items
            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['product']->price,
                ]);
            }

            DB::commit();

            // Clear cart
            session(['cart' => []]);

            // Redirect to thank you page with order details
            return redirect()
                ->route('checkout.thankyou', $order->id)
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->route('checkout.index')
                ->with('error', 'Failed to place order. Please try again.');
        }
    }

    /**
     * Show thank you page after order placement
     */
    public function thankyou(Order $order)
    {
        $order->load(['items.product']);
        return view('pages.thankyou', compact('order'));
    }
}
