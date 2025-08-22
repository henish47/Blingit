<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; // Import the Category model
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $products = $query->latest()->paginate(10);
        
        // Fetch all categories from the 'categories' table to populate the dropdowns.
        $categories = Category::orderBy('name')->get();

        return view('admin.products', compact('products', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'sku' => 'required|string|min:5|max:50|unique:products,sku',
            'category' => 'required|string|exists:categories,name', // Ensure the category exists
            'price' => 'required|numeric|min:0|max:99999.99',
            'stock' => 'required|integer|min:0|max:9999',
            'description' => 'required|string|min:10',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,avif,webp|max:2048'
        ]);

        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
         $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'sku' => ['required', 'string', 'min:5', 'max:50', Rule::unique('products')->ignore($product->id)],
            'category' => 'required|string|exists:categories,name', // Ensure the category exists
            'price' => 'required|numeric|min:0|max:99999.99',
            'stock' => 'required|integer|min:0|max:9999',
            'description' => 'required|string|min:10',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,avif,webp|max:2048'
        ]);

        if ($request->hasFile('img')) {
            if ($product->img) {
                Storage::disk('public')->delete($product->img);
            }
            $validated['img'] = $request->file('img')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->img) {
            Storage::disk('public')->delete($product->img);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
