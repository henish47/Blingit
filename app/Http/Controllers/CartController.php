<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Category; // <-- Category model ne import karyo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the shopping cart page.
     */
    public function index()
    {
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();

        // Pahela, fakt active categories na naam j lavo.
        $activeCategoryNames = Category::where('status', 'Active')->pluck('name');

        // Have, fakt active products j lavo je active category ma hoy.
        $cartProductIds = $cartItems->pluck('product_id');
        $recommendedProducts = Product::where('status', 'Active')
                                     ->whereIn('category', $activeCategoryNames) // <-- Mukhya Sudharo
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
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->withErrors(['error' => 'Not enough stock available for ' . $product->name]);
        }

        $cartItem = CartItem::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->first();

        if ($cartItem) {
            // Jo product pahelathi j cart ma hoy to quantity vadharo
            $cartItem->increment('quantity', $request->quantity);
        } else {
            // Jo navo product hoy to tene add karo
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', $product->name . ' has been added to your cart!');
    }

    /**
     * Update the quantity of a cart item.
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->firstOrFail();
        
        if ($cartItem->product->stock < $request->quantity) {
            return back()->withErrors(['error' => 'Not enough stock available.']);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        CartItem::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->delete();

        return back()->with('success', 'Item removed from cart.');
    }
}

