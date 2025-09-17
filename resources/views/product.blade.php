@extends('layout')

@section('title', $product->name . ' | Blingit Grocery')

@section('content')
<style>
    /* Custom style for the new in-place image zoom effect */
    #image-wrapper {
        overflow: hidden; /* Jaroori chhe jethi zoom thati image container ni bahar na jay */
        cursor: zoom-in;
        border-radius: 0.5rem; /* Container na rounded corners jadvay te mate */
    }

    #product-image {
        transition: transform 0.3s ease; /* Zoom effect ne smooth banavva mate */
    }

    /* Jyare cursor image container par aave, tyare image ne zoom karo */
    #image-wrapper:hover #product-image {
        transform: scale(2); /* Zoom level set karo (2 = 200% zoom) */
    }

    /* Nani (mobile) screen par aa zoom effect bandh rakho */
    @media (max-width: 768px) {
        #image-wrapper:hover #product-image {
            transform: scale(1); /* Zoom ne disable karo */
        }
        #image-wrapper {
            cursor: default;
        }
    }
</style>

<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Single Product Display -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center bg-white rounded-xl p-8 shadow-lg">
        
        <!-- Product Image Section -->
        <div class="product-image-container">
            <div id="image-wrapper" class="flex justify-center items-center p-4 bg-gray-50 rounded-lg">
                <img id="product-image" src="{{ $product->image_url }}" alt="{{ $product->name }}" class="max-w-full h-64 object-contain rounded-lg shadow-md" onerror="this.onerror=null;this.src='https://placehold.co/300x250/E0E0E0/666666?text=Image+Not+Found';">
            </div>
            <!-- Zoom result pane has been removed -->
        </div>

        <!-- Product Details Section -->
        <div class="flex flex-col gap-4">
            <h1 class="text-4xl font-extrabold text-gray-900 leading-tight">{{ $product->name }}</h1>
            <p class="text-lg text-gray-600 font-medium">{{ $product->sku }}</p>
            
            <p class="text-4xl font-extrabold text-green-700">₹{{ number_format($product->price, 2) }}</p>
            
            <div class="flex items-center gap-2 text-base text-gray-700">
                <span class="font-semibold">Category:</span> {{ $product->category }}
            </div>
            <div class="flex items-center gap-2 text-base text-gray-700">
                <span class="font-semibold">Availability:</span> <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }} font-medium">{{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</span>
            </div>
            <div class="flex items-center gap-2 text-base text-gray-700">
                <span class="font-semibold">Delivery:</span> <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full font-bold text-sm">8 MINS</span>
            </div>

            <p class="text-gray-700 leading-relaxed mt-4 text-base">{{ $product->description }}</p>

            <div class="mt-6">
                @if($product->stock > 0)
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
                @else
                    <button type="button" class="w-full md:w-auto px-10 py-4 text-xl font-bold rounded-lg bg-gray-300 text-gray-500 cursor-not-allowed flex items-center justify-center gap-3" disabled>
                        <i class="fa fa-times-circle text-2xl"></i> Out of Stock
                    </button>
                @endif
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageWrapper = document.getElementById('image-wrapper');
        const productImage = document.getElementById('product-image');

        if (imageWrapper && productImage) {
            imageWrapper.addEventListener('mousemove', function(e) {
                // Image na hisabe cursor ni position calculate karo
                const rect = imageWrapper.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                // Wrapper ni size lavo
                const width = imageWrapper.offsetWidth;
                const height = imageWrapper.offsetHeight;

                // transform-origin ne cursor ni position pramane set karo
                // Aa step ne કારણે image cursor ni taraf zoom thashe
                const xPercent = (x / width) * 100;
                const yPercent = (y / height) * 100;
                
                productImage.style.transformOrigin = `${xPercent}% ${yPercent}%`;
            });

            // Jyare cursor image parthi hati jay, tyare zoom out effect ne smooth banavo
            imageWrapper.addEventListener('mouseleave', function() {
                productImage.style.transformOrigin = 'center center';
            });
        }
    });
</script>
@endsection

