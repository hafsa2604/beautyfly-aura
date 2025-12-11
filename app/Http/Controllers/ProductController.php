<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of products with filtering and sorting.
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        $this->applyFilters($query, $request);
        $this->applySorting($query, $request->query('sort', ''));

        $products = $query->select('products.*')
            ->distinct()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::all();

        return view('pages.products', [
            'products' => $products,
            'selectedType' => $request->query('type', 'all'),
            'searchTerm' => $request->query('search', ''),
            'selectedSort' => $request->query('sort', ''),
            'categories' => $categories
        ]);
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product) // Route Model Binding
    {
        $product->load(['category', 'reviews.user']);
        $reviews = $product->reviews()->latest()->get();

        return view('pages.product-details', compact('product', 'reviews'));
    }

    /**
     * Ajax search endpoint.
     */
    public function search(Request $request)
    {
        $query = $request->input('search', '');
        
        if (empty($query)) {
            return response()->json(['products' => []]);
        }

        $products = Product::with('category')
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', '%' . $query . '%')
                  ->orWhereHas('category', fn($cat) => $cat->where('name', 'LIKE', '%' . $query . '%'));
            })
            ->limit(10)
            ->get()
            ->map(fn($product) => [
                'id' => $product->id,
                'title' => $product->title,
                'category' => $product->category->name ?? 'N/A',
                'price' => number_format($product->price),
                'image' => $product->image ? asset('images/' . $product->image) : asset('images/placeholder.jpg'),
                'url' => route('product.show', $product->id),
            ]);

        return response()->json(['products' => $products]);
    }

    /**
     * Store a newly created review in storage.
     */
    public function addReview(Request $request, Product $product) // Route Model Binding
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:50',
            'review' => 'required|string|max:500',
            'rating' => 'nullable|integer|min:1|max:5',
            'image'  => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = $this->handleImageUpload($request);

        \App\Models\Review::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'review' => $validated['review'],
            'rating' => $validated['rating'] ?? 5,
            'image' => $imageName,
        ]);

        return redirect()->route('product.show', $product->id)
            ->with('success', 'Thank you for your review!');
    }

    /**
     * Apply filters to the product query.
     */
    private function applyFilters($query, Request $request)
    {
        if ($request->filled('type') && $request->type !== 'all') {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->type));
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%$searchTerm%")
                  ->orWhere('desc', 'like', "%$searchTerm%");
            });
        }
    }

    /**
     * Apply sorting to the product query.
     */
    private function applySorting($query, $sort)
    {
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }
    }

    /**
     * Handle image upload.
     */
    private function handleImageUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/reviews'), $imageName);
            return $imageName;
        }
        return null;
    }
}
