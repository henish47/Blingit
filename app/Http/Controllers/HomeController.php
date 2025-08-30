<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Banner;
use App\Models\Product; // Ensure Product model is imported
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch active banners, ordered by 'order_column'
        $banners = Banner::where('is_active', 1)->orderBy('order_column', 'asc')->get();

        // Fetch 'Active' categories and load their 'Active' products
        $categoriesWithProducts = Category::where('status', 'Active')
            ->with(['products' => function ($query) {
                // For each active category, fetch up to 6 products that are ALSO 'Active'.
                $query->where('status', 'Active')->take(6); 
            }])->get();

        // Pass both banners and categories with products to the view
        return view('home', compact('banners', 'categoriesWithProducts'));
    }
}

