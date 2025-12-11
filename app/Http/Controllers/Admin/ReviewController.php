<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with(['product', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $review->load(['product', 'user']);
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'rating', 'review']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($review->image && file_exists(public_path('images/reviews/' . $review->image))) {
                unlink(public_path('images/reviews/' . $review->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/reviews'), $imageName);
            $data['image'] = $imageName;
        }

        $review->update($data);

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully.');
    }
}
