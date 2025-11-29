<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Products listing page
    public function index(Request $request)
    {
        $products = Product::with('category');

        // Get query parameters with defaults
        $selectedType = $request->query('type') ?? 'all';
        $searchTerm   = $request->query('search') ?? '';
        $selectedSort = $request->query('sort') ?? '';

        // Filter by skin type (category)
        if ($selectedType !== 'all') {
            $products->whereHas('category', function ($q) use ($selectedType) {
                $q->where('slug', $selectedType);
            });
        }

        // Search by title or description
        if (!empty($searchTerm)) {
            $products->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%$searchTerm%")
                    ->orWhere('desc', 'like', "%$searchTerm%");
            });
        }

        // Sorting
        switch ($selectedSort) {
            case 'price_asc':
                $products->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $products->orderBy('price', 'desc');
                break;
            case 'newest':
                $products->orderBy('created_at', 'desc');
                break;
            default:
                $products->orderBy('created_at', 'desc');
        }

        $products = $products->select('products.*')
            ->distinct()
            ->paginate(12)
            ->withQueryString();

        // Get categories for filter dropdown
        $categories = Category::all();

        // Pass all variables to the view
        return view('pages.products', compact('products', 'selectedType', 'searchTerm', 'selectedSort', 'categories'));
    }

    // Single product details
    public function show($id)
    {
        $product = Product::with(['category', 'reviews.user'])->findOrFail($id);
        $reviews = $product->reviews()->orderBy('created_at', 'desc')->get();

        return view('pages.product-details', compact('product', 'reviews'));
    }

    // Add a review
    public function addReview(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|string|max:50',
            'review' => 'required|string|max:500',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $product = Product::findOrFail($id);

        \App\Models\Review::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'review' => $request->review,
            'rating' => $request->rating ?? 5,
        ]);

        return redirect()->route('product.show', $id)
            ->with('success', 'Thank you for your review!');
    }
}
