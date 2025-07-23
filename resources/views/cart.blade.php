@extends('layout')

@section('title', 'Cart | Blingit Grocery')

@section('content')
{{-- 
  This Blade template displays the user's shopping cart.
  - It uses Tailwind CSS for styling and is designed to be responsive.
  - It dynamically displays cart items or an "empty cart" message.
  - Includes an order summary and a section for recommended products.
  - All icons have been converted to inline SVGs for better performance and customization.
  - Custom CSS animations have been removed for a cleaner implementation.
--}}
<div class="bg-gray-50 font-sans">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 flex items-center gap-3 mb-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Your Shopping Cart
        </h1>

        @php
            // Mock data for cart items. In a real application, this would come from the session or database.
            $cartItems = [
                [
                    'img' => '\images\amulgold.avif',
                    'name' => 'Amul Gold Milk',
                    'price' => 34,
                    'qty' => 2,
                    'total' => 68
                ],
                [
                    'img' => '\images\banana.jpeg',
                    'name' => 'Banana (1 dozen)',
                    'price' => 60,
                    'qty' => 1,
                    'total' => 60
                ],
                [
                    'img' => '\images\onion.webp',
                    'name' => 'Fresh Onion',
                    'price' => 40,
                    'qty' => 3,
                    'total' => 120
                ]
            ];
            $subtotal = array_sum(array_column($cartItems, 'total'));

            // Mock data for recommended products.
            $recommendedProducts = [
                ['title' => 'Fresh Tomato', 'size' => '500 g', 'price' => '20', 'img' => '\images\Tomato.webp'],
                 [ 'title' => 'Amul Butter', 'size' => '500 g', 'price' => '₹265', 'img' => '/images/Amul Butter.avif' ],
                ['title' => 'Oranges', 'size' => '1 kg', 'price' => '₹85', 'img' => '/images/Oranges.jpeg'],
                ['title' => 'Grapes (Green)', 'size' => '500 g', 'price' => '₹55', 'img' => '/images/Grapes (Green).jpeg'],
                 [ 'title' => 'Country Eggs (Brown)', 'size' => '6 pcs', 'price' => '₹68', 'img' => '/images/Country Eggs (Brown).jpeg' ],
            ];
        @endphp

        @if(count($cartItems) > 0)
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
                            @foreach($cartItems as $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $item['img'] }}" class="w-16 h-16 object-cover rounded-lg border border-gray-200 shadow-sm" alt="{{ $item['name'] }}" onerror="this.onerror=null;this.src='https://placehold.co/64x64/f0f0f0/999999?text=Image';">
                                        <span class="font-semibold text-gray-800 text-base">{{ $item['name'] }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <span class="font-bold text-gray-700 text-base">₹{{ number_format($item['price'], 2) }}</span>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="bg-gray-200 text-gray-700 w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-300 transition disabled:opacity-50 disabled:cursor-not-allowed" @if($item['qty']==1) disabled @endif>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
                                        </button>
                                        <span class="px-4 py-1 font-bold text-gray-800 text-base border border-gray-300 rounded-md">{{ $item['qty'] }}</span>
                                        <button class="bg-gray-200 text-gray-700 w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-300 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                        </button>
                                    </div>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <span class="font-extrabold text-green-700 text-base">₹{{ number_format($item['total'], 2) }}</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <button class="text-gray-400 hover:text-red-600 rounded-full p-2 transition-colors duration-200" title="Remove item">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
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
                            <span class="font-semibold text-gray-900">₹{{ $subtotal >= 500 ? '0.00' : '40.00' }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <div class="flex items-center justify-between text-lg font-bold text-gray-900">
                                <span>Total</span>
                                <span class="text-green-700">₹{{ number_format($subtotal + ($subtotal >= 500 ? 0 : 40), 2) }}</span>
                            </div>
                        </div>
                    </div>

                    @php $deliveryThreshold = 500; @endphp
                    @if($subtotal < $deliveryThreshold)
                    <div class="mt-6 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-lg px-4 py-3 text-sm flex items-center gap-3 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2 2h8a1 1 0 001-1zM3 11h10" /></svg>
                        <span>Add <b>₹{{ number_format($deliveryThreshold - $subtotal, 2) }}</b> more for FREE delivery!</span>
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
            <a href="/shop" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-full font-bold text-base shadow-lg hover:shadow-green-500/30 transition-all duration-300 ease-in-out transform hover:-translate-y-1 flex items-center gap-2">
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
                <div class="swiper-slide">
                   
                    <div class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-all p-4 flex flex-col justify-between group">
                        <!-- Image -->
                        <a href="{{ route('personal-products') }}" class="block group">   
                        <div class="relative">
                            <img src="{{ $product['img'] }}" alt="{{ $product['title'] }}" class="w-full h-32 object-contain mb-3 transition-transform duration-200 group-hover:scale-105" onerror="this.onerror=null;this.src='https://placehold.co/150x128/E0E0E0/666666?text=Image+Not+Found';">
                            <!-- Delivery badge -->
                            <div class="absolute top-0 left-0 bg-green-100 text-green-600 text-xs font-semibold px-2 py-0.5 rounded-br-md flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                                </svg>
                                8 MINS
                            </div>
                        </div>
                         </a>
                        <!-- Product Info -->
                        <div class="flex-1 flex flex-col justify-between text-center">
                            <h3 class="text-base font-bold text-gray-800 line-clamp-2 leading-snug mb-1">{{ $product['title'] }}</h3>
                            <p class="text-sm text-gray-500 mb-2">{{ $product['size'] }}</p>
                        </div>
                        <!-- Price + Add Button -->
                        <div class="flex items-center justify-between mt-3">
                            <span class="text-xl font-extrabold text-green-700">{{ $product['price'] }}</span>
                            <button onclick="event.stopPropagation(); window.location.href='{{ url('/cart') }}';" class="px-5 py-2 text-sm font-semibold rounded-lg border-2 border-green-600 text-green-700 bg-green-50 hover:bg-green-600 hover:text-white transition duration-300 ease-in-out shadow-sm">
                                ADD
                            </button>
                        </div>
                    </div>
               
            </div>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="/" class="inline-block bg-white hover:bg-gray-100 text-gray-800 px-8 py-3 rounded-full font-bold text-base shadow-md border border-gray-300 transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
