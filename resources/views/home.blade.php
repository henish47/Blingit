@extends('layout')

@section('title', 'Home | Blingit Grocery')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <style>
        /* Top Banner Swiper Styles */
        .topBannerSwiper .swiper-slide {
            position: relative; text-align: center; display: flex; justify-content: center; align-items: center;
        }
        .topBannerSwiper .swiper-slide img {
            display: block; width: 100%; height: 400px; object-fit: cover;
        }
        .swiper-button-next, .swiper-button-prev {
            color: #22c55e; background-color: rgba(255, 255, 255, 0.8); border-radius: 50%;
            width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); transition: all 0.3s ease-in-out;
        }
        .swiper-button-next:hover, .swiper-button-prev:hover {
            background-color: #22c55e; color: #fff;
            box-shadow: 0 6px 16px rgba(34, 197, 94, 0.3); transform: scale(1.05);
        }
        .swiper-button-next::after, .swiper-button-prev::after {
            font-size: 20px !important; font-weight: bold;
        }
        .swiper-pagination-bullet {
            background-color: #a1ffce !important; opacity: 1 !important; transition: all 0.3s ease-in-out;
            width: 10px !important; height: 10px !important;
        }
        .swiper-pagination-bullet-active {
            background-color: #22c55e !important; transform: scale(1.2);
        }
        .line-clamp-2 {
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }

    </style>

    <div class="container mx-auto px-4 py-10">
        
        <!-- Main Banner Carousel (Dynamic) -->
        @if(isset($banners) && $banners->isNotEmpty())
            <div class="swiper topBannerSwiper mb-12 rounded-2xl overflow-hidden shadow-xl">
                <div class="swiper-wrapper">
                    @foreach($banners as $banner)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $banner->image_url) }}" alt="{{ $banner->alt_text ?? 'Blingit Grocery Banner' }}" onerror="this.onerror=null;this.src='https://placehold.co/1200x400/E0E0E0/666666?text=Image+Not+Available';">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        @endif


        <!-- Product Categories Sections -->
        @foreach($categoriesWithProducts as $category)
            @if($category->products->isNotEmpty())
                <div class="mb-12">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800">{{ $category->name }}</h2>
                        <a href="{{ route('category.products', $category) }}" class="text-green-600 font-semibold hover:underline text-lg inline-flex items-center gap-1">
                            See All
                            <!-- Replaced Font Awesome icon with an inline SVG for better performance -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Product Grid (Updated for better responsiveness across all screen sizes) -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                        @foreach($category->products as $product)
                            <div class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-all p-4 flex flex-col justify-between group h-full">
                                <a href="{{ route('product.show', $product) }}" class="block group">
                                    <div class="relative">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                             class="w-full h-32 object-contain mb-3 transition-transform duration-200 group-hover:scale-105"
                                             onerror="this.onerror=null;this.src='https://placehold.co/150x128/E0E0E0/666666?text=Image+Not+Found';">
                                        
                                        {{-- Low Stock Badge --}}
                                        @if($product->stock > 0 && $product->stock <= 10)
                                            <div class="absolute top-0 right-0 bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-0.5 rounded-bl-md">
                                                Only {{ $product->stock }} left
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                <div class="flex-1 flex flex-col justify-between text-center mt-2">
                                    <div>
                                        <h3 class="text-base font-bold text-gray-800 line-clamp-2 leading-snug mb-1">{{ $product->name }}</h3>
                                        <p class="text-sm text-gray-500 mb-2 truncate">{{ $product->description }}</p>
                                    </div>
                                    <div class="flex items-center justify-between mt-3">
                                        <span class="text-xl font-extrabold text-green-700">₹{{ number_format($product->price, 2) }}</span>
                                        
                                        @if($product->stock > 0)
                                            @auth
                                                <form action="{{ route('cart.add') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="px-5 py-2 text-sm font-semibold rounded-lg border-2 border-green-600 text-green-700 bg-green-50 hover:bg-green-600 hover:text-white transition duration-300 ease-in-out shadow-sm">
                                                        ADD
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-semibold rounded-lg border-2 border-green-600 text-green-700 bg-green-50 hover:bg-green-600 hover:text-white transition duration-300 ease-in-out shadow-sm">
                                                    ADD
                                                </a>
                                            @endauth
                                        @else
                                            <button class="px-5 py-2 text-sm font-semibold rounded-lg border-2 border-gray-300 text-gray-500 bg-gray-100 cursor-not-allowed" disabled>
                                                Out of Stock
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        <!-- How Blingit Works Section -->
        <div class="bg-gray-50 p-8 rounded-2xl my-12">
            <h2 class="text-2xl font-bold mb-8 text-center text-gray-800">How Blingit Works</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">1. Add Products</h3>
                    <p class="text-gray-600">Browse our fresh selection and add items to your cart</p>
                </div>
                <div class="text-center">
                    <div class="bg-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">2. Checkout Securely</h3>
                    <p class="text-gray-600">Complete your order with our safe payment options</p>
                </div>
                <div class="text-center">
                    <div class="bg-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">3. Fast Delivery</h3>
                    <p class="text-gray-600">Get your groceries delivered fresh to your doorstep</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Top Banner Swiper
            new Swiper('.topBannerSwiper', {
                loop: true,
                effect: 'fade',
                fadeEffect: { crossFade: true },
                autoplay: { delay: 4000, disableOnInteraction: false, },
                // *** MUKHYA SUDHARO AHIYA CHHE ***
                // Corrected the pagination selector from '.pagination' to '.swiper-pagination'
                pagination: { el: '.topBannerSwiper .swiper-pagination', clickable: true, },
                navigation: { nextEl: '.topBannerSwiper .swiper-button-next', prevEl: '.topBannerSwiper .swiper-button-prev', },
            });
        });
    </script>
@endsection

