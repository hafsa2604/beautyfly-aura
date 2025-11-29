<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{
    public function home()
    {
        // Get latest 4 products for best sellers section
        $bestSellers = Product::orderBy('created_at', 'desc')->take(4)->get();
        return view('pages.home', compact('bestSellers'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        \App\Models\Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        return redirect()->route('contact')->with('success', 'Message sent. Thank you!');
    }

    public function subscribeNewsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255'
        ]);

        // Check if email already exists
        $existing = \App\Models\Newsletter::where('email', $validated['email'])->first();

        if ($existing) {
            return back()->with('info', 'You are already subscribed to our newsletter!');
        }

        // Create new subscription
        \App\Models\Newsletter::create([
            'email' => $validated['email'],
        ]);

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
