<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class PlaceOrderController extends Controller
{
    /**
     * Display the specific order confirmation page.
     */
    public function show(Order $order)
    {
        // Security Check: Chokkas karo ke aa order login karela user no j chhe.
        if ($order->user_id !== Auth::id()) {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }

        // Check karo ke aa order no review pahelathi j aapvama aavyo chhe ke nahi.
        $reviewExists = Review::where('order_id', $order->id)
                              ->where('user_id', Auth::id())
                              ->exists();

        // Order, teni items, ane review status ne view ma pass karo.
        $order->load('items.product');

        return view('place-order', compact('order', 'reviewExists'));
    }
}

