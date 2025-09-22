<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PlaceOrderController extends Controller
{
    /**
     * Display the order confirmation page.
     * It fetches the most recent order for the logged-in user.
     */
    public function show()
    {
        // User na chhella order ne teni items sathe fetch karo.
        $order = Order::where('user_id', Auth::id())
                      ->with('items.product') // Eager load items and their associated products
                      ->latest() // Sauthi navo order pahela
                      ->first();

        // Jo koi order na male, to homepage par redirect karo.
        if (!$order) {
            return redirect()->route('home')->with('error', 'Could not find your recent order.');
        }

        return view('place-order', compact('order'));
    }
}
