<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'rating'   => 'required|integer|min:1|max:5',
            'comment'  => 'required|string|min:10|max:500',
        ]);

        // Ensure the order belongs to the current user
        $order = Order::where('id', $validated['order_id'])
                      ->where('user_id', Auth::id())
                      ->first();

        if (!$order) {
            return response()->json([
                'message' => 'You are not authorized to review this order.'
            ], 403);
        }

        // Prevent duplicate review for the same order by this user
        $alreadyReviewed = Review::where('order_id', $validated['order_id'])
                                 ->where('user_id', Auth::id())
                                 ->exists();

        if ($alreadyReviewed) {
            return response()->json([
                'message' => 'You have already submitted a review for this order.'
            ], 409);
        }

        $review = Review::create([
            'user_id'  => Auth::id(),
            'order_id' => $validated['order_id'],
            'rating'   => $validated['rating'],
            'comment'  => $validated['comment'],
            'status'   => 'pending',
        ]);

        return response()->json([
            'message' => 'Thank you for your review! It will be visible once approved.',
            'review'  => $review,
        ], 201);
    }

    /**
     * Show all reviews (admin purpose).
     */
    public function index()
    {
        // Eager load user relation for each review
        $reviews = Review::with('user')->latest()->get();

        return view('admin.review', compact('reviews'));
    }

    /**
     * Approve a review (admin only).
     */
    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['status' => 'approved']);

        return back()->with('success', 'Review approved successfully.');
    }

    /**
     * Delete a review.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
    }
}
