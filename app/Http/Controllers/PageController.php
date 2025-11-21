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

        // For starter version we just redirect back with message
        return redirect()->route('contact')->with('success', 'Message sent. Thank you!');
    }
}
