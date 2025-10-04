<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SearchController extends Controller
{
    /**
     * Handle the product search request.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return redirect()->back()->with('error', 'Please enter a search term.');
        }

        // Get active category names first
        $activeCategoryNames = Category::where('status', 'Active')->pluck('name');

        // Search for active products within active categories
        $products = Product::where('status', 'Active')
                            ->whereIn('category', $activeCategoryNames)
                            ->where(function ($q) use ($query) {
                                $q->where('name', 'LIKE', "%{$query}%")
                                  ->orWhere('description', 'LIKE', "%{$query}%")
                                  ->orWhere('sku', 'LIKE', "%{$query}%");
                            })
                            ->paginate(20); // Show 20 products per page

        return view('search-results', [
            'products' => $products,
            'query' => $query,
        ]);
    }
}
