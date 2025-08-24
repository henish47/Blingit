<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch only active categories and eager load their latest 5 products
        $categoriesWithProducts = Category::where('status', true)
            ->with(['products' => function ($query) {
                $query->latest()->take(5);
            }])->get();

        return view('home', [
            'categoriesWithProducts' => $categoriesWithProducts,
        ]);
    }
}
