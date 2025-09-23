<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the shopping cart page.
     */
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // Active category names
        $activeCategoryNames = Category::where('status', 'Active')->pluck('name');

        // Recommended products (active + not already in cart)
        $cartProductIds = $cartItems->pluck('product_id');
        $recommendedProducts = Product::where('status', 'Active')
            ->whereIn('category', $activeCategoryNames)
            ->whereNotIn('id', $cartProductIds)
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
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return redirect()->route('cart.index')
                ->withErrors(['error' => 'Only ' . $product->stock . ' items left in stock for ' . $product->name]);
        }

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
        } else {
            CartItem::create([
                'user_id'    => Auth::id(),
                'product_id' => $product->id,
                'quantity'   => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', $product->name . ' has been added to your cart!');
    }

    /**
     * Update the quantity of a cart item.
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->firstOrFail();

        if ($cartItem->product->stock < $request->quantity) {
            return redirect()->route('cart.index')
                ->withErrors(['error' => 'Only ' . $cartItem->product->stock . ' items left in stock.']);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')
            ->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('cart.index')
            ->with('success', 'Item removed from cart.');
    }
}
