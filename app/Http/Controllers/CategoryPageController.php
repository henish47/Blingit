<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryPageController extends Controller
{
    /**
     * Show all products for a specific category.
     */
    public function show(Category $category)
    {
        // *** MUKHYA SUDHARO AHIYA CHHE ***
        // Category mathi products lavti vakhate, fakt 'Active' status vala products j shodho.
        $products = $category->products()
                             ->where('status', 'Active')
                             ->paginate(15); // Ek page par 15 products batavo

        return view('category-products', compact('category', 'products'));
    }
}
