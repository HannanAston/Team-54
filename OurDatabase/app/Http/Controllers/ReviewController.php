<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        // Check if user already reviewed this product
        $existingReview = Review::where('user_id', auth()->id())
                                ->where('product_id', $product->id)
                                ->first();

        if ($existingReview) {
            // Update existing review
            $existingReview->update($validated);
            return back()->with('success', 'Your review has been updated!');
        } else {
            // Create new review
            Review::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'rating' => $validated['rating'],
                'review' => $validated['review'],
            ]);
            return back()->with('success', 'Thank you for your review!');
        }
    }

    public function destroy(Review $review)
    {
        // Only allow user to delete their own review
        if ($review->user_id !== auth()->id()) {
            return back()->with('error', 'You can only delete your own reviews!');
        }

        $review->delete();
        return back()->with('success', 'Review deleted successfully!');
    }
}