@extends('layout')

@section('title', 'Electronics | Blingit Grocery')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Electronics Header -->
    <div class="flex items-center justify-between mb-6" data-aos="fade-up">
        <h2 class="text-4xl font-extrabold text-gray-800">Electronics</h2>
    </div>

    <!-- Electronics Product Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6" data-aos="fade-up" data-aos-delay="100">
        @php
            $electronics = [
                ['title' => 'Smartphone (Brand X)', 'size' => '6.1" Display, 128GB', 'price' => '₹15,999', 'img' => 'https://placehold.co/150x128/E0E0E0/666666?text=Smartphone'],
                ['title' => 'Wireless Headphones', 'size' => 'Noise Cancelling', 'price' => '₹4,499', 'img' => 'https://placehold.co/150x128/E0E0E0/666666?text=Headphones'],
                ['title' => 'Smartwatch (Fitness Tracker)', 'size' => 'Heart Rate Monitor', 'price' => '₹2,999', 'img' => 'https://placehold.co/150x128/E0E0E0/666666?text=Smartwatch'],
                ['title' => 'Portable Bluetooth Speaker', 'size' => 'Waterproof, 10W', 'price' => '₹1,899', 'img' => 'https://placehold.co/150x128/E0E0E0/666666?text=Speaker'],
                ['title' => 'Power Bank (10000 mAh)', 'size' => 'Fast Charging', 'price' => '₹999', 'img' => 'https://placehold.co/150x128/E0E0E0/666666?text=Powerbank'],
                ['title' => 'USB-C to USB-A Cable', 'size' => '1 Meter, Braided', 'price' => '₹249', 'img' => 'https://placehold.co/150x128/E0E0E0/666666?text=USB+Cable'],
                ['title' => 'Gaming Mouse', 'size' => 'RGB, 16000 DPI', 'price' => '₹1,499', 'img' => 'https://placehold.co/150x128/E0E0E0/666666?text=Gaming+Mouse'],
                ['title' => 'Wireless Keyboard', 'size' => 'Compact, Bluetooth', 'price' => '₹2,199', 'img' => 'https://placehold.co/150x128/E0E0E0/666666?text=Keyboard'],
                ['title' => 'Webcam (Full HD)', 'size' => '1080p, Built-in Mic', 'price' => '₹1,799', 'img' => 'https://placehold.co/150x128/E0E0E0/666666?text=Webcam'],
                ['title' => 'Smart LED Bulb', 'size' => 'Wi-Fi, Dimmable', 'price' => '₹599', 'img' => 'https://placehold.co/150x128/E0E0E0/666666?text=Smart+Bulb'],
            ];
        @endphp

        @foreach($electronics as $product)
        
                    <div class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-all p-4 flex flex-col justify-between group h-full">
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
        @endforeach
    </div>
</div>

<!-- Optional: Clamp CSS -->
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
