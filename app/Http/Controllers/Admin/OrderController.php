<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Mail\OrderStatusMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        
        $oldStatus = $order->status;
        $newStatus = $request->status;
        $order->update(['status' => $newStatus]);

        // Send email notification if status changed and user has email
        if ($oldStatus !== $newStatus && $order->email) {
            $this->sendStatusUpdateEmail($order);
        }

        return back()->with('success', "Order #{$order->id} status has been updated to {$newStatus}.");
    }

    /**
     * Send status update email to customer
     */
    private function sendStatusUpdateEmail(Order $order)
    {
        try {
            // Prepare email data
            $emailData = [
                'order_id' => $order->id,
                'customer_name' => $order->user->name ?? $order->name ?? 'Customer',
                'status' => $order->status,
                'order_date' => $order->created_at->format('F d, Y'),
                'payment_method' => $order->payment_method ?? 'N/A',
                'subtotal' => $order->subtotal ?? 0,
                'discount' => $order->discount ?? 0,
                'delivery_fee' => $order->delivery_fee ?? 0,
                'total' => $order->total,
                'address' => $order->address ?? 'N/A',
                'city' => $order->city ?? 'N/A',
                'state' => $order->state ?? 'N/A',
                'zip' => $order->zip ?? 'N/A',
                'items' => $order->items->map(function ($item) {
                    return [
                        'name' => $item->name,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                    ];
                })->toArray(),
            ];

            // Send email
            Mail::to($order->email)->send(new OrderStatusMail($emailData));
            
        } catch (\Exception $e) {
            // Log error but don't break the status update
            \Log::error('Failed to send order status email: ' . $e->getMessage());
        }
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

