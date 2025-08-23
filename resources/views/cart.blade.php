@extends('layout')

@section('title', 'Cart | Blingit Grocery')

@section('content')
<div class="bg-gray-50 font-sans">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 flex items-center gap-3 mb-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Your Shopping Cart
        </h1>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cartItems) > 0)
        @php
            $subtotal = 0;
            foreach($cartItems as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
            $deliveryFee = $subtotal >= 500 ? 0 : 40;
            $total = $subtotal + $deliveryFee;
        @endphp
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12 items-start">
            
            <!-- Cart Items Table -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-100">
                            <tr class="text-gray-600 uppercase text-sm font-semibold tracking-wider">
                                <th class="py-4 px-6 text-left">Product</th>
                                <th class="py-4 px-6 text-left">Price</th>
                                <th class="py-4 px-6 text-center">Quantity</th>
                                <th class="py-4 px-6 text-left">Total</th>
                                <th class="py-4 px-6 text-center">Remove</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($cartItems as $id => $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $item['image_url'] }}" class="w-16 h-16 object-cover rounded-lg border border-gray-200 shadow-sm" alt="{{ $item['name'] }}">
                                        <span class="font-semibold text-gray-800 text-base">{{ $item['name'] }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <span class="font-bold text-gray-700 text-base">₹{{ number_format($item['price'], 2) }}</span>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <form action="{{ route('cart.update') }}" method="POST" class="flex items-center justify-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 text-center font-bold text-gray-800 text-base border border-gray-300 rounded-md" onchange="this.form.submit()">
                                    </form>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <span class="font-extrabold text-green-700 text-base">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <button type="submit" class="text-yellow-400 hover:text-red-600 rounded-full p-2 transition-colors duration-200" title="Remove item">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="sticky top-28 bg-white border border-gray-200 rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 border-b border-gray-200 pb-4 mb-4">Order Summary</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between text-base text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-semibold text-gray-900">₹{{ number_format($subtotal, 2) }}</span>
                        </div>
                         <div class="flex items-center justify-between text-base text-gray-600">
                            <span>Delivery Fee</span>
                            <span class="font-semibold text-gray-900">₹{{ number_format($deliveryFee, 2) }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <div class="flex items-center justify-between text-lg font-bold text-gray-900">
                                <span>Total</span>
                                <span class="text-green-700">₹{{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    @if($subtotal < 500)
                    <div class="mt-6 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-lg px-4 py-3 text-sm flex items-center gap-3 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2 2h8a1 1 0 001-1zM3 11h10" /></svg>
                        <span>Add <b>₹{{ number_format(500 - $subtotal, 2) }}</b> more for FREE delivery!</span>
                    </div>
                    @else
                    <div class="mt-6 bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 text-sm flex items-center gap-3 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>You've qualified for FREE delivery!</span>
                    </div>
                    @endif

                    <a href="/checkout" class="mt-6 w-full bg-green-600 hover:bg-green-700 text-white text-center px-6 py-3.5 rounded-xl font-bold text-base shadow-lg hover:shadow-green-500/30 transition-all duration-300 ease-in-out transform hover:-translate-y-1 flex items-center justify-center gap-2">
                        Proceed to Checkout
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </a>
                </div>
            </div>
        </div>
        @else
        <!-- Empty Cart -->
        <div class="flex flex-col items-center justify-center text-center py-20 bg-white rounded-2xl shadow-lg border border-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-300 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <h2 class="text-gray-800 text-2xl font-semibold mb-2">Your cart is empty!</h2>
            <p class="text-gray-500 text-base mb-8 max-w-sm">Looks like you haven't added anything yet. Start exploring our fresh products to fill it up.</p>
            <a href="{{ route('home') }}" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-full font-bold text-base shadow-lg hover:shadow-green-500/30 transition-all duration-300 ease-in-out transform hover:-translate-y-1 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                Start Shopping
            </a>
        </div>
        @endif

        <!-- Recommended Products Section -->
        <div class="mt-16 sm:mt-24">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-6 text-center">You Might Also Like</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                @foreach($recommendedProducts as $product)
                <div class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-all p-4 flex flex-col justify-between group">
                    <a href="{{ route('product.show', $product) }}" class="block group">
                        <div class="relative">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-32 object-contain mb-3 transition-transform duration-200 group-hover:scale-105">
                        </div>
                    </a>
                    <div class="flex-1 flex flex-col justify-between text-center">
                        <h3 class="text-base font-bold text-gray-800 line-clamp-2 leading-snug mb-1">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500 mb-2 truncate">{{ $product->description }}</p>
                    </div>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-xl font-extrabold text-green-700">₹{{ number_format($product->price, 2) }}</span>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="px-5 py-2 text-sm font-semibold rounded-lg border-2 border-green-600 text-green-700 bg-green-50 hover:bg-green-600 hover:text-white transition duration-300 ease-in-out shadow-sm">
                                ADD
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
