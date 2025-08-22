<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function userOrders()
    {
        $orders = [
            (object) [
                'id' => 1001,
                'date' => '2024-07-01',
                'total' => 450.00,
                'status' => 'Completed',
                'address' => '123 Main St, City',
                'payment_method' => 'Credit Card',
            ],
            (object) [
                'id' => 1002,
                'date' => '2024-07-02',
                'total' => 320.00,
                'status' => 'Pending',
                'address' => '456 Park Ave, City',
                'payment_method' => 'UPI',
            ],
        ];
        return view('orders', compact('orders'));
    }
} 