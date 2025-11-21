<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('admin.products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'desc' => 'nullable|string',
            'benefits' => 'nullable|string',
            'usage' => 'nullable|string',
        ]);

        $data = $request->only(['title','type','price','desc','benefits','usage']);
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
        return view('admin.products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'desc' => 'nullable|string',
            'benefits' => 'nullable|string',
            'usage' => 'nullable|string',
        ]);

        $data = $request->only(['title','type','price','desc','benefits','usage']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if($product->image && file_exists(public_path('images/'.$product->image))){
                unlink(public_path('images/'.$product->image));
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
        if($product->image && file_exists(public_path('images/'.$product->image))){
            unlink(public_path('images/'.$product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success','Product deleted successfully.');
    }
}
