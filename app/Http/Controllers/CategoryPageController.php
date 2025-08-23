<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryPageController extends Controller
{
    /**
     * Show all products for a specific category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Category $category)
    {
        // Eager load all products for the given category and paginate them
        $products = $category->products()->latest()->paginate(15);

        return view('category-products', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
