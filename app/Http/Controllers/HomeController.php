<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application home page with products from each category.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch all categories and eager load the latest 5 products for each one.
        $categoriesWithProducts = Category::with(['products' => function ($query) {
            $query->latest()->take(5);
        }])->get();

        return view('home', [
            'categoriesWithProducts' => $categoriesWithProducts,
        ]);
    }
}
