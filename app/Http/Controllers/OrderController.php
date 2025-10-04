<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the authenticated user's orders.
     */
    public function userOrders()
    {
        $orders = Order::where('user_id', Auth::id())
                        ->with('items.product') // Eager load order items and their products
                        ->latest() // Show the most recent orders first
                        ->paginate(10); // Paginate the results

        return view('orders', compact('orders'));
    }
}

