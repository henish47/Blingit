<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();
            
        $recommendedProducts = Product::whereNotIn('id', $cartItems->pluck('product_id'))
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('cart', compact('cartItems', 'recommendedProducts'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        $newQuantity = $cartItem ? $cartItem->quantity + $request->quantity : $request->quantity;

        // Check if the requested quantity exceeds the available stock
        if ($product->stock < $newQuantity) {
            return back()->withErrors(['error' => 'Cannot add more items than available in stock.']);
        }

        if ($cartItem) {
            // If item exists, increment quantity
            $cartItem->increment('quantity', $request->quantity);
        } else {
            // If item is new, create it
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }
        
        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public function update(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:' . $product->stock, // Add max validation rule
        ]);

        CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        
        CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->delete();

        return back()->with('success', 'Product removed from cart successfully!');
    }
}
