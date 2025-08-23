@extends('layout')

@section('title', $product->name . ' | Blingit Grocery')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Single Product Display -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center bg-white rounded-xl p-8 shadow-lg">
        
        <!-- Product Image Section -->
        <div class="flex justify-center items-center p-4 bg-gray-50 rounded-lg">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="max-w-full h-64 object-contain rounded-lg shadow-md" onerror="this.onerror=null;this.src='https://placehold.co/300x250/E0E0E0/666666?text=Image+Not+Found';">
        </div>

        <!-- Product Details Section -->
        <div class="flex flex-col gap-4">
            <h1 class="text-4xl font-extrabold text-gray-900 leading-tight">{{ $product->name }}</h1>
            <p class="text-lg text-gray-600 font-medium">{{ $product->sku }}</p>
            
            <!-- Price -->
            <p class="text-4xl font-extrabold text-green-700">₹{{ number_format($product->price, 2) }}</p>
            
            <!-- Additional Info -->
            <div class="flex items-center gap-2 text-base text-gray-700">
                <span class="font-semibold">Category:</span> {{ $product->category }}
            </div>
            <div class="flex items-center gap-2 text-base text-gray-700">
                <span class="font-semibold">Availability:</span> <span class="text-green-600 font-medium">{{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</span>
            </div>
            <div class="flex items-center gap-2 text-base text-gray-700">
                <span class="font-semibold">Delivery:</span> <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full font-bold text-sm">8 MINS</span>
            </div>

            <p class="text-gray-700 leading-relaxed mt-4 text-base">{{ $product->description }}</p>

            <!-- Add to Cart Button -->
            <div class="mt-6">
                @auth
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full md:w-auto px-10 py-4 text-xl font-bold rounded-lg bling-btn shadow-xl hover:shadow-2xl transition duration-300 ease-in-out flex items-center justify-center gap-3">
                            <i class="fa fa-shopping-cart text-2xl"></i> Add to Cart
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="w-full md:w-auto px-10 py-4 text-xl font-bold rounded-lg bling-btn shadow-xl hover:shadow-2xl transition duration-300 ease-in-out flex items-center justify-center gap-3">
                        <i class="fa fa-shopping-cart text-2xl"></i> Add to Cart
                    </a>
                @endauth
            </div>
        </div>
    </div>
    
    <!-- About Blingit Grocery Section -->
    <div class="mt-20 p-10 bg-white rounded-3xl shadow-2xl border border-yellow-100 text-center">
        <h2 class="text-4xl font-extrabold text-gray-900 mb-6">About Blingit Grocery</h2>
        <p class="text-lg text-gray-700 leading-relaxed max-w-3xl mx-auto mb-6">
            At Blingit Grocery, we are committed to bringing you the freshest and highest quality groceries right to your doorstep, with lightning-fast delivery. Our mission is to make healthy and convenient living accessible to everyone. We carefully select our products, ensuring that you receive only the best, from farm-fresh produce to essential dairy and pantry staples.
        </p>
        <a href="{{ route('home') }}" class="inline-block mt-8 px-8 py-4 text-xl font-bold rounded-xl bling-btn shadow-xl hover:shadow-2xl transition duration-300 ease-in-out">
            Explore All Products <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
</div>
@endsection
