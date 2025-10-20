<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        // Example featured products will be provided by ProductController normally.
        return view('pages.home');
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
