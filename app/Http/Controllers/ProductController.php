<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Products listing page
    public function index(Request $request)
    {
        $products = Product::query();

        // Get query parameters with defaults
        $selectedType = $request->query('type') ?? 'all';
        $searchTerm   = $request->query('search') ?? '';
        $selectedSort = $request->query('sort') ?? '';

        // Filter by skin type
        if ($selectedType !== 'all') {
            $products->where('type', $selectedType);
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

        // Pass all variables to the view
        return view('pages.products', compact('products', 'selectedType', 'searchTerm', 'selectedSort'));
    }

    // Single product details
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Example static reviews
        $reviews = [
            (object)['name' => 'Sara', 'review' => 'Amazing product, my skin feels soft!'],
            (object)['name' => 'Ali', 'review' => 'Helped reduce oil and acne. Highly recommended!'],
        ];

        return view('pages.product-details', compact('product', 'reviews'));
    }

    // Add a review (dummy for now)
    public function addReview(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|string|max:50',
            'review' => 'required|string|max:500',
        ]);

        // For now we are not saving reviews in the database
        return redirect()->route('product.show', $id)
            ->with('success', 'Thank you for your review!');
    }
}
