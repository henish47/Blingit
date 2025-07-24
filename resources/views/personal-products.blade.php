@extends('layout')

@section('title', 'Product Page | Blingit Grocery')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Single Product Display -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center bg-white rounded-xl p-8 shadow-lg">
        @php
            $product = [
                'title' => 'Amul Gold Full Cream Milk',
                'size' => '500 ml',
                'price' => '₹34',
                'img' => '/images/amulgold.avif',
                'description' => 'Amul Gold Full Cream Milk is a rich and creamy milk, homogenized and standardized for consistent quality. It is packed with essential nutrients and is perfect for daily consumption, making tea, coffee, or preparing delicious desserts. This milk is sourced from the finest dairies, ensuring freshness and purity with every drop. Enjoy it chilled or use it in your favorite recipes.',
                'brand' => 'Amul',
                'availability' => 'In Stock',
                'delivery_time' => '8 MINS',
                'reviews_count' => 125
            ];
        @endphp

        <!-- Product Image Section -->
        <div class="flex justify-center items-center p-4 bg-gray-50 rounded-lg">
            <img src="{{ $product['img'] }}" alt="{{ $product['title'] }}" class="max-w-full h-64 object-contain rounded-lg shadow-md" onerror="this.onerror=null;this.src='https://placehold.co/300x250/E0E0E0/666666?text=Image+Not+Found';">
        </div>

        <!-- Product Details Section -->
        <div class="flex flex-col gap-4">
            <h1 class="text-4xl font-extrabold text-gray-900 leading-tight">{{ $product['title'] }}</h1>
            <p class="text-lg text-gray-600 font-medium">{{ $product['size']}}</p>
            
            <!-- Price -->
            <p class="text-4xl font-extrabold text-green-700">{{ $product['price']}}</p>
            
            <!-- Additional Info -->
            <div class="flex items-center gap-2 text-base text-gray-700">
                <span class="font-semibold">Brand:</span> {{ $product['brand']}}
            </div>
            <div class="flex items-center gap-2 text-base text-gray-700">
                <span class="font-semibold">Availability:</span> <span class="text-green-600 font-medium">{{ $product['availability']}}</span>
            </div>
            <div class="flex items-center gap-2 text-base text-gray-700">
                <span class="font-semibold">Delivery:</span> <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full font-bold text-sm">{{ $product['delivery_time']}}</span>
            </div>

            <p class="text-gray-700 leading-relaxed mt-4 text-base">{{ $product['description']}}</p>

            <!-- Add to Cart Button -->
            <button class="w-full md:w-auto px-10 py-4 mt-6 text-xl font-bold rounded-lg bling-btn shadow-xl hover:shadow-2xl transition duration-300 ease-in-out flex items-center justify-center gap-3">
                <i class="fa fa-shopping-cart text-2xl"></i> Add to Cart
            </button>
        </div>
    </div>
    
    <!-- About Blingit Grocery Section -->
    <div class="mt-20 p-10 bg-white rounded-3xl shadow-2xl border border-yellow-100 text-center animate-fade-in-up animation-delay-700">
        <h2 class="text-4xl font-extrabold text-gray-900 mb-6">About Blingit Grocery</h2>
        <p class="text-lg text-gray-700 leading-relaxed max-w-3xl mx-auto mb-6">
            At Blingit Grocery, we are committed to bringing you the freshest and highest quality groceries right to your doorstep, with lightning-fast delivery. Our mission is to make healthy and convenient living accessible to everyone. We carefully select our products, ensuring that you receive only the best, from farm-fresh produce to essential dairy and pantry staples.
        </p>
        <p class="text-lg text-gray-700 leading-relaxed max-w-3xl mx-auto">
            Experience the ease of online grocery shopping with Blingit – where quality meets convenience, and your satisfaction is our top priority.
        </p>
        <a href="#" class="inline-block mt-8 px-8 py-4 text-xl font-bold rounded-xl bling-btn shadow-xl hover:shadow-2xl transition duration-300 ease-in-out">
            Explore All Products <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
</div>
@endsection
