<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceOrderController extends Controller
{
    public function show()
    {
        $order = (object) [
            'id' => 1001,
            'total' => 113,
            'address' => '123 Main St',
            'state' => 'Delhi',
            'zip' => '110001',
        ];
        $items = [
            [
                'img' => 'https://www.bigbasket.com/media/uploads/p/l/1203470_2-amul-gold-homogenised-standardised-milk.jpg',
                'name' => 'Amul Gold Full Cream Milk',
                'qty' => 2,
                'price' => 34,
                'total' => 68,
            ],
            [
                'img' => 'https://www.bigbasket.com/media/uploads/p/l/40075561_2-fresho-banana-robusta.jpg',
                'name' => 'Banana Robusta',
                'qty' => 1,
                'price' => 45,
                'total' => 45,
            ],
        ];
        return view('place-order', compact('order', 'items'));
    }
} 