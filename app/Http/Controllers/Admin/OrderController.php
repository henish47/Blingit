<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // *** MUKHYA SUDHARO AHIYA CHHE ***
        // Have, controller darek order ni sathe teni items ane product ni mahiti pan lavshe.
        $query = Order::with('user', 'items.product')->latest();

        // Search by Order ID or Customer Name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $orders = $query->paginate(10);

        return view('admin.orders', compact('orders'));
    }

    /**
     * Update the status of an order.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:Pending,Processing,Shipped,Completed,Cancelled']);
        
        $order->update(['status' => $request->status]);

        return back()->with('success', "Order #{$order->id} status has been updated to {$request->status}.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', "Order #{$order->id} has been deleted successfully.");
    }
}

