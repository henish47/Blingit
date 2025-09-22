<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
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
            'full_name'       => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'address'         => 'required|string|max:255',
            'city'            => 'required|string|max:255',
            'state'           => 'required|string|max:255',
            'zip'             => 'required|string|max:10',
            'payment_method'  => 'required|string|in:cod,razorpay',
        ]);

        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        // ---------- Totals ----------
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }
        
        $discount = session()->get('coupon')['discount'] ?? 0;
        $deliveryFee = ($subtotal - $discount) >= 500 ? 0 : 40;
        $total = ($subtotal - $discount) + $deliveryFee;

        // ---------- Payment Handling ----------
        $paymentId = null;
        $status = 'pending';

        if ($request->payment_method === 'razorpay') {
            if (!$request->has('razorpay_payment_id')) {
                return back()->withErrors(['payment' => 'Payment failed or cancelled, please try again.']);
            }
            $paymentId = $request->razorpay_payment_id;
            $status = 'paid'; // since Razorpay auto-capture enabled
        }

        if ($request->payment_method === 'cod') {
            $status = 'cod_pending';
        }

        // ---------- Create Order ----------
        $order = Order::create([
            'user_id'        => Auth::id(),
            'name'           => $request->full_name,
            'email'          => $request->email,
            'address'        => $request->address,
            'city'           => $request->city,
            'state'          => $request->state,
            'zip'            => $request->zip,
            'subtotal'       => $subtotal,
            'discount'       => $discount,
            'delivery_fee'   => $deliveryFee,
            'total'          => $total,
            'payment_method' => $request->payment_method,
            'payment_id'     => $paymentId,
            'status'         => $status,
        ]);

        // ---------- Save Items ----------
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'name'       => $item->product->name,
                'price'      => $item->product->price,
                'quantity'   => $item->quantity,
            ]);
        }

        // ---------- Cleanup ----------
        CartItem::where('user_id', Auth::id())->delete();
        session()->forget('coupon');

        // Redirect to thank you / place-order page
        return redirect()->route('place.order', $order->id)
                         ->with('success', 'Your order has been placed successfully!');
    }

    /**
     * Show Thank You / Place Order Page
     */
    public function thankYou(Order $order)
    {
        return view('place-order', compact('order'));
    }

    /**
     * Apply a coupon to the cart.
     */
    public function applyCoupon(Request $request)
    {
        $request->validate(['coupon_code' => 'required|string']);

        $coupon = Coupon::where('code', $request->coupon_code)
            ->where('status', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->first();

        if (!$coupon) {
            return back()->withErrors(['coupon_code' => 'Invalid or expired coupon code.']);
        }

        $subtotal = 0;
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }

        $discount = 0;
        if ($coupon->type == 'fixed') {
            $discount = $coupon->value;
        } elseif ($coupon->type == 'percent') {
            $discount = ($subtotal * $coupon->value) / 100;
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => $discount,
        ]);

        return back()->with('success', 'Coupon applied successfully!');
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
        return back()->with('success', 'Coupon removed.');
    }
}
