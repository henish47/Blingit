@extends('layout')

@section('title', 'Electronics | Blingit Grocery')

@section('content')

<div class="bg-gray-50 font-sans">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <!-- Header -->
        <div class="mb-6 md:mb-8 text-center">
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight">Electronics</h1>
            <p class="mt-2 max-w-2xl mx-auto text-base sm:text-lg text-gray-600">
                Discover the latest gadgets and everyday electronics at unbeatable prices — delivered to your door.
            </p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            
            @php
                $electronics_products = [
                    [ 'title' => 'Smartphone (Brand X)', 'size' => '6.1" Display, 128GB', 'price' => '₹15,999', 'img' => '/images/Smartphone (Brand X).jpg' ],
            [ 'title' => 'Wireless Headphones', 'size' => 'Noise Cancelling', 'price' => '₹4,499', 'img' => '/images/Wireless Headphones.png' ],
            [ 'title' => 'Smartwatch (Fitness Tracker)', 'size' => 'Heart Rate Monitor', 'price' => '₹2,999', 'img' => '/images/Smartwatch (Fitness Tracker).jpg' ],
            [ 'title' => 'Portable Bluetooth Speaker', 'size' => 'Waterproof, 10W', 'price' => '₹1,899', 'img' => '/images/Portable Bluetooth Speaker.jpg' ],
            [ 'title' => 'Power Bank (10000 mAh)', 'size' => 'Fast Charging', 'price' => '₹999', 'img' => '/images/Power Bank (10000 mAh).jpeg' ],
            [ 'title' => 'Apple Airpods Pro', 'size' => 'Better Music', 'price' => '₹999', 'img' => '/images/apple airpodspro.jpeg' ],
                    ['title' => 'Zebronics USB Keyboard', 'size' => '1 Unit', 'price' => '₹499', 'img' => '\images\Zebronics USB Keyboard.webp'],
                    ['title' => 'Sony Wired Earphones MDR-EX150AP', 'size' => '1 Unit', 'price' => '₹849', 'img' => '\images\Sony Wired Earphones.jpeg'],
                    ['title' => 'Smart WiFi Plug (16A)', 'size' => '1 Unit', 'price' => '₹1199', 'img' => '\images\Smart WiFi Plug.webp'],
                    ['title' => 'Syska 4 Socket Extension Board', 'size' => '1 Unit', 'price' => '₹399', 'img' => '\images\Syska 4 Socket Extension Board.jpg'],
                ];
            @endphp

            @foreach($electronics_products as $product)
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all p-3 sm:p-4 flex flex-col justify-between group h-full">
                <!-- Image -->
                <a href="{{ route('personal-products') }}" class="block group">
                    <div class="relative">
                        <img src="{{ $product['img'] }}" alt="{{ $product['title'] }}" class="w-full h-28 sm:h-32 object-contain mb-2 sm:mb-3 transition-transform duration-200 group-hover:scale-105" onerror="this.onerror=null;this.src='https://placehold.co/150x128/E0E0E0/666666?text=Image+Not+Found';">
                        <!-- Delivery badge -->
                        <div class="absolute top-0 left-0 bg-green-100 text-green-600 text-xs font-semibold px-2 py-0.5 rounded-br-md flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                            </svg>
                            15 MINS
                        </div>
                    </div>
                </a>
                <!-- Product Info -->
                <div class="flex-1 flex flex-col justify-between text-center">
                    <h3 class="text-sm sm:text-base font-bold text-gray-800 line-clamp-2 leading-snug mb-1">{{ $product['title'] }}</h3>
                    <p class="text-xs sm:text-sm text-gray-500 mb-2">{{ $product['size'] }}</p>
                </div>
                <!-- Price + Add Button -->
                <div class="flex items-center justify-between mt-2 sm:mt-3">
                    <span class="text-lg sm:text-xl font-extrabold text-green-700">{{ $product['price'] }}</span>
                    <button onclick="event.stopPropagation(); window.location.href='{{ url('/cart') }}';" class="px-3 sm:px-5 py-1.5 sm:py-2 text-xs sm:text-sm font-semibold rounded-lg border-2 border-green-600 text-green-700 bg-green-50 hover:bg-green-600 hover:text-white transition duration-300 ease-in-out shadow-sm">
                        ADD
                    </button>
                </div>
            </div>
            @endforeach
        </div>
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
    @media (max-width: 640px) {
        .container {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }
    }
    @media (max-width: 400px) {
        .line-clamp-2 {
            font-size: 0.95rem;
        }
    }
</style>
@endsection
