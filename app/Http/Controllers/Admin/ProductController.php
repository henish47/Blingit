<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search filter
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('sku', 'like', '%' . $request->search . '%');
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->latest()->paginate(10);
        $categories = Category::orderBy('name')->get();

        return view('admin.products', compact('products', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'        => 'required|string|min:3|max:255',
            'sku'         => 'required|string|min:5|max:50|unique:products,sku',
            'category'    => 'required|string|exists:categories,name',
            'price'       => 'required|numeric|min:0|max:99999.99',
            'stock'       => 'required|integer|min:0|max:9999',
            'description' => 'required|string|min:10',
            'status'      => 'required|in:Active,Inactive', // Status validation added
            'img'         => 'required|image|mimes:jpeg,png,jpg,gif,svg,avif,webp|max:20480',
        ]);
        
        $dataToCreate = $validatedData;
        
        $imagePath = $request->file('img')->store('products', 'public');
        $dataToCreate['img'] = $imagePath; 

        Product::create($dataToCreate);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // 1. Define the validation rules, including the status.
        $rules = [
            'name'        => 'required|string|min:3|max:255',
            'sku'         => ['required', 'string', 'min:5', 'max:50', Rule::unique('products')->ignore($product->id)],
            'category'    => 'required|string|exists:categories,name',
            'price'       => 'required|numeric|min:0|max:99999.99',
            'stock'       => 'required|integer|min:0|max:9999',
            'description' => 'required|string|min:10',
            'status'      => 'required|in:Active,Inactive', // Status is now always required
        ];

        // 2. Conditionally add the image validation rule ONLY if a new file is being uploaded.
        if ($request->hasFile('img')) {
            $rules['img'] = 'required|image|mimes:jpeg,png,jpg,gif,svg,avif,webp|max:2048';
        }

        // 3. Run the validation.
        $validatedData = $request->validate($rules);

        // Prepare the data for updating.
        $dataToUpdate = $validatedData;

        // 4. If a new image was uploaded, handle file storage.
        if ($request->hasFile('img')) {
            if ($product->img) {
                Storage::disk('public')->delete($product->img);
            }
            $imagePath = $request->file('img')->store('products', 'public');
            $dataToUpdate['img'] = $imagePath;
        }

        // 5. Update the product.
        $product->update($dataToUpdate);

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

