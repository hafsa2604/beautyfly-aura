<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('created_at','desc')
            ->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'desc' => 'nullable|string',
            'benefits' => 'nullable|string',
            'usage' => 'nullable|string',
        ]);

        $data = $request->only(['title','category_id','price','desc','benefits','usage']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['image'] = $filename;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success','Product added successfully.');
    }

    // Show edit form
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'desc' => 'nullable|string',
            'benefits' => 'nullable|string',
            'usage' => 'nullable|string',
        ]);

        $data = $request->only(['title','category_id','price','desc','benefits','usage']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            // Check if any other products are using the old image before deleting it
            $oldImage = $product->image;
            $otherProductsUsingImage = Product::where('image', $oldImage)
                ->where('id', '!=', $product->id)
                ->count();

            // Only delete the old image file if no other products are using it
            if($oldImage && $otherProductsUsingImage == 0 && file_exists(public_path('images/'.$oldImage))){
                unlink(public_path('images/'.$oldImage));
            }
            
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['image'] = $filename;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success','Product updated successfully.');
    }

    // Delete product
    public function destroy(Product $product)
    {
        // Check if any other products are using the same image before deleting it
        $imageToDelete = $product->image;
        $otherProductsUsingImage = Product::where('image', $imageToDelete)
            ->where('id', '!=', $product->id)
            ->count();

        // Only delete the image file if no other products are using it
        if($imageToDelete && $otherProductsUsingImage == 0 && file_exists(public_path('images/'.$imageToDelete))){
            unlink(public_path('images/'.$imageToDelete));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success','Product deleted successfully.');
    }
}
