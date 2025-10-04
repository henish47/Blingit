<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user')
                         ->whereIn('status', ['approved', 'pending'])
                         ->latest()
                         ->take(4)
                         ->get();

        // Fallback: show latest reviews if none match the filter
        if ($reviews->isEmpty()) {
            $reviews = Review::with('user')
                             ->latest()
                             ->take(4)
                             ->get();
        }

        return view('about', compact('reviews'));
    }
}
