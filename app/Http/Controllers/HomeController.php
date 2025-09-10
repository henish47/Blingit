<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch active banners, ordered by 'order_column'
        $banners = Banner::where('is_active', 1)
            ->orderBy('order_column', 'asc')
            ->get();

        // Fetch active categories and their products
        $categoriesWithProducts = Category::where('status', 'Active')
            ->with(['products' => function ($query) {
                $query->where('status', 'Active')
                      ->orderBy('id', 'desc'); // optional: latest products first
            }])
            ->get()
            ->map(function ($category) {
                // Only take 5 products per category
                $category->setRelation('products', $category->products->take(5));
                return $category;
            });

        // Pass both banners and categories with products to the view
        return view('home', compact('banners', 'categoriesWithProducts'));
    }
}
