@extends('layout')

@section('title', 'My Orders | Blingit Grocery')

@section('content')

<div class="bg-gray-50 min-h-screen font-sans">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Page Header -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 flex items-center gap-3">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Order History
            </h1>
            <div class="flex items-center gap-2 bg-white p-2 rounded-full shadow-sm border border-gray-200">
                <button class="px-4 py-1.5 text-sm font-semibold text-white bg-green-600 rounded-full">Active</button>
                <button class="px-4 py-1.5 text-sm font-semibold text-gray-600 hover:bg-gray-100 rounded-full">Completed</button>
                <button class="px-4 py-1.5 text-sm font-semibold text-gray-600 hover:bg-gray-100 rounded-full">Cancelled</button>
            </div>
        </div>

        @php
            // Mock data for orders. In a real application, this would come from the controller.
            $orders = [
                [
                    'id' => 'BLINGIT-12345',
                    'date' => 'July 18, 2025',
                    'total' => 100.00,
                    'status' => 'Processing',
                    'address' => '123, Sunrise Apartments, Rajkot',
                    'payment_method' => 'Cash on Delivery',
                    'products' => [
                        ['img' => 'https://www.bigbasket.com/media/uploads/p/l/10000159_27-fresho-potato.jpg'],
                        ['img' => 'https://www.bigbasket.com/media/uploads/p/l/10000068_22-fresho-carrot-ooty.jpg'],
                    ]
                ],
                [
                    'id' => 'BLINGIT-12340',
                    'date' => 'July 15, 2025',
                    'total' => 250.50,
                    'status' => 'Completed',
                    'address' => '456, Moonlit Towers, Rajkot',
                    'payment_method' => 'Razorpay',
                    'products' => [
                        ['img' => 'https://www.bigbasket.com/media/uploads/p/l/10000203_16-fresho-tomato-hybrid.jpg'],
                        ['img' => 'https://www.bigbasket.com/media/uploads/p/l/10000203_16-fresho-tomato-hybrid.jpg'],
                        ['img' => 'https://www.bigbasket.com/media/uploads/p/l/10000203_16-fresho-tomato-hybrid.jpg'],
                    ]
                ],
                 [
                    'id' => 'BLINGIT-12298',
                    'date' => 'July 12, 2025',
                    'total' => 75.00,
                    'status' => 'Cancelled',
                    'address' => '789, Star Avenue, Rajkot',
                    'payment_method' => 'Cash on Delivery',
                    'products' => [
                         ['img' => 'https://www.bigbasket.com/media/uploads/p/l/40075561_2-fresho-banana-robusta.jpg'],
                    ]
                ],
            ];
        @endphp

        @if(count($orders) > 0)
        <div class="space-y-6">
            @foreach($orders as $order)
                @php
                    $statusClasses = [
                        'Processing' => ['bg-blue-100', 'text-blue-800', 'border-blue-200'],
                        'Completed' => ['bg-green-100', 'text-green-800', 'border-green-200'],
                        'Cancelled' => ['bg-red-100', 'text-red-800', 'border-red-200'],
                        'Out for Delivery' => ['bg-yellow-100', 'text-yellow-800', 'border-yellow-200'],
                    ];
                    $currentStatusClass = $statusClasses[$order['status']] ?? ['bg-gray-100', 'text-gray-800', 'border-gray-200'];
                @endphp
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 transition-shadow hover:shadow-xl">
                <!-- Order Header -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-4 border-b border-gray-200">
                    <div>
                        <p class="text-sm text-gray-500">Order ID</p>
                        <p class="font-bold text-lg text-green-600">{{ $order['id'] }}</p>
                    </div>
                    <div class="mt-2 sm:mt-0 sm:text-right">
                        <p class="text-sm text-gray-500">Placed on</p>
                        <p class="font-semibold text-gray-800">{{ $order['date'] }}</p>
                    </div>
                </div>
                
                <!-- Order Body -->
                <div class="py-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Product Images -->
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-4">
                            @foreach(array_slice($order['products'], 0, 3) as $product)
                            <img src="{{ $product['img'] }}" class="w-14 h-14 rounded-full border-4 border-white object-cover shadow-md" alt="Product Image" onerror="this.onerror=null;this.src='https://placehold.co/56x56/f0f0f0/999999?text=Img';">
                            @endforeach
                        </div>
                        @if(count($order['products']) > 3)
                        <div class="w-14 h-14 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold text-sm border-4 border-white shadow-md">
                            +{{ count($order['products']) - 3 }}
                        </div>
                        @endif
                    </div>
                    
                    <!-- Status & Total -->
                    <div class="flex flex-col justify-center">
                        <p class="text-sm text-gray-500">Status</p>
                        <span class="inline-block px-3 py-1 rounded-full font-semibold text-sm self-start {{ implode(' ', $currentStatusClass) }}">
                            {{ $order['status'] }}
                        </span>
                    </div>
                    <div class="flex flex-col justify-center md:text-right">
                        <p class="text-sm text-gray-500">Total Amount</p>
                        <p class="font-extrabold text-2xl text-gray-900">₹{{ number_format($order['total'], 2) }}</p>
                    </div>
                </div>

                <!-- Order Footer / Actions -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3 pt-4 border-t border-gray-200">
                    <a href="#" class="w-full sm:w-auto text-center bg-gray-100 hover:bg-gray-200 text-gray-800 px-5 py-2.5 rounded-lg font-semibold text-sm transition-colors">
                        View Details
                    </a>
                    @if($order['status'] !== 'Cancelled' && $order['status'] !== 'Completed')
                    <a href="#" class="w-full sm:w-auto text-center bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg font-semibold text-sm transition-colors shadow-lg hover:shadow-green-500/30">
                        Track Order
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center text-center py-20 bg-gray-50 rounded-2xl shadow-inner border border-gray-200">
            <svg class="w-20 h-20 text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            <h2 class="text-gray-800 text-2xl font-semibold mb-2">No orders to show</h2>
            <p class="text-gray-500 text-base mb-8 max-w-sm">It looks like you haven't placed any orders yet. Let's change that!</p>
            <a href="/shop" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-full font-bold text-base shadow-lg hover:shadow-green-500/30 transition-all duration-300 ease-in-out transform hover:-translate-y-1 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                Start Shopping
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
