<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        return view('checkout', compact('cartItems'));
    }

    /**
     * Place the order.
     */
    public function placeOrder(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'payment_method' => 'required|string|in:cod,razorpay',
        ]);

        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;
        foreach($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $deliveryFee = $subtotal >= 500 ? 0 : 40;
        $total = $subtotal + $deliveryFee;

        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->full_name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'total' => $total,
            'payment_method' => $request->payment_method,
        ]);

        foreach ($cartItems as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'name' => $details['name'],
                'price' => $details['price'],
                'quantity' => $details['quantity'],
            ]);
        }

        // Clear the cart from the session
        session()->forget('cart');

        // Redirect to a success page (we'll use the place-order route for this)
        return redirect()->route('place-order')->with('success', 'Your order has been placed successfully!');
    }
}
