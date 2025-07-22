@extends('layout')

@section('title', 'Home | Blingit Grocery')

@section('content')

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- SwiperJS CDN for Carousel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <style>
        /* Custom styles for the new Top Banner Swiper */
        .topBannerSwiper .swiper-slide {
            position: relative;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .topBannerSwiper .swiper-slide img {
            display: block;
            width: 100%;
            height: 400px;
            /* Increased height for better visual impact */
            object-fit: cover;
        }

        .topBannerSwiper .slide-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            padding: 20px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 12px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        .topBannerSwiper .slide-content h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .topBannerSwiper .slide-content p {
            font-size: 1.25rem;
        }

        /* Custom styles for Swiper navigation and pagination */
        .swiper-button-next,
        .swiper-button-prev {
            color: #22c55e;
            /* Green color for arrows */
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            width: 44px;
            /* Slightly larger for main banner */
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease-in-out;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background-color: #22c55e;
            color: #fff;
            box-shadow: 0 6px 16px rgba(34, 197, 94, 0.3);
            transform: scale(1.05);
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 20px !important;
            /* Adjust arrow size */
            font-weight: bold;
        }

        .swiper-pagination-bullet {
            background-color: #a1ffce !important;
            /* Light green for inactive dots */
            opacity: 1 !important;
            transition: all 0.3s ease-in-out;
            width: 10px !important;
            height: 10px !important;
        }

        .swiper-pagination-bullet-active {
            background-color: #22c55e !important;
            /* Darker green for active dot */
            transform: scale(1.2);
        }

        /* Line clamping for product titles */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <div class="container mx-auto px-4 py-10">
        <!-- SwiperJS Carousel (Top Banner) -->
        <div class="swiper topBannerSwiper mb-10 rounded-2xl overflow-hidden shadow-xl" data-aos="fade-up">
            <div class="swiper-wrapper">
                @php
                    $banners = [
                        ['img' => 'https://storage.googleapis.com/gemini-generative-ai-api/f43701b2d634e963/fresh_groceries_banner.jpg', 'title' => 'Fresh Groceries Delivered', 'subtitle' => 'The best quality produce, right to your doorstep.'],
                        ['img' => 'https://storage.googleapis.com/gemini-generative-ai-api/f43701b2d634e963/daily_deals_banner.jpg', 'title' => 'Daily Deals and Offers', 'subtitle' => 'Unbeatable prices on your favorite items, every single day.'],
                        ['img' => 'https://storage.googleapis.com/gemini-generative-ai-api/a06180344211e533/image.jpg', 'title' => 'Quality You Can Trust', 'subtitle' => 'Sourced from the best farms to ensure premium quality.'],
                    ];
                @endphp
                @foreach($banners as $banner)
                    <div class="swiper-slide">
                        <img src="{{ $banner['img'] }}" alt="{{ $banner['title'] }}"
                            onerror="this.onerror=null;this.src='https://placehold.co/1200x400/E0E0E0/666666?text=Image+Not+Available';">
                        <div class="slide-content">
                            <h2 class="text-4xl md:text-5xl font-extrabold mb-2 tracking-tight">{{ $banner['title'] }}</h2>
                            <p class="text-lg md:text-xl font-light">{{ $banner['subtitle'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>

        <!-- Milk & Eggs Section -->
        <div class="flex items-center justify-between mb-4" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800">Milk Eggs</h2>
            <a href="{{ route('milk') }}" class="text-green-600 font-semibold hover:underline text-lg">See All <i
                    class="fas fa-arrow-right ml-1"></i></a>
        </div>
        <div class="swiper productSwiper mb-10 p-2" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                @php
                    $milk_eggs_products = [
                        ['title' => 'Amul Gold Full Cream Milk', 'size' => '500 ml', 'price' => '₹34', 'img' => '\images\amulgold.avif'],

                        ['title' => 'Amul Taaza Toned Milk', 'size' => '1 L', 'price' => '₹54', 'img' => '\images\amultazaatonedmilk.png'],

                        ['title' => 'Country Fresh Eggs', 'size' => '12 pcs', 'price' => '₹89', 'img' => '\images\contryfresheggs.webp'],

                        ['title' => 'Nestle Milkmaid', 'size' => '400g Tin', 'price' => '₹135', 'img' => '\images\nestlemilkmaid.jpg'],

                        ['title' => 'Mother Dairy Curd', 'size' => '400 g', 'price' => '₹30', 'img' => '\images\Mother Dairy Curd.webp'],

                        ['title' => 'Amul Butter', 'size' => '500 g', 'price' => '₹265', 'img' => '\images\Amul Butter.avif'],
                    ];
                @endphp
                @foreach($milk_eggs_products as $product)
                    <div class="swiper-slide">

                        <div
                            class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-all p-4 flex flex-col justify-between group h-full">
                            <!-- Image -->
                            <a href="{{ route('personal-products') }}" class="block group">
                                <div class="relative">
                                    <img src="{{ $product['img'] }}" alt="{{ $product['title'] }}"
                                        class="w-full h-32 object-contain mb-3 transition-transform duration-200 group-hover:scale-105"
                                        onerror="this.onerror=null;this.src='https://placehold.co/150x128/E0E0E0/666666?text=Image+Not+Found';">
                                    <!-- Delivery badge -->
                                    <div
                                        class="absolute top-0 left-0 bg-green-100 text-green-600 text-xs font-semibold px-2 py-0.5 rounded-br-md flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3" />
                                        </svg>
                                        8 MINS
                                    </div>
                                </div>
                            </a>
                            <!-- Product Info -->
                            <div class="flex-1 flex flex-col justify-between text-center">
                                <h3 class="text-base font-bold text-gray-800 line-clamp-2 leading-snug mb-1">
                                    {{ $product['title'] }}</h3>
                                <p class="text-sm text-gray-500 mb-2">{{ $product['size'] }}</p>
                            </div>
                            <!-- Price + Add Button -->
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-xl font-extrabold text-green-700">{{ $product['price'] }}</span>
                                <button onclick="event.stopPropagation(); window.location.href='{{ url('/cart') }}';"
                                    class="px-5 py-2 text-sm font-semibold rounded-lg border-2 border-green-600 text-green-700 bg-green-50 hover:bg-green-600 hover:text-white transition duration-300 ease-in-out shadow-sm">
                                    ADD
                                </button>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination mt-4"></div>
        </div>

        <!-- Vegetables Section -->
        <div class="flex items-center justify-between mb-4" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800">Fresh Vegetables</h2>
            <a href="{{ route('vegetables') }}" class="text-green-600 font-semibold hover:underline text-lg">See All <i
                    class="fas fa-arrow-right ml-1"></i></a>
        </div>
        <div class="swiper productSwiper mb-10 p-2" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                @php
                    $vegetables_products = [
                        ['title' => 'Onion', 'size' => '1 kg', 'price' => '₹30', 'img' => '/images/onion.webp'],

                        ['title' => 'Potato', 'size' => '1 kg', 'price' => '₹25', 'img' => '/images/potato.webp'],

                        ['title' => 'Tomato (Hybrid)', 'size' => '500 g', 'price' => '₹20', 'img' => '/images/Tomato.webp'],

                        ['title' => 'Carrot (Orange)', 'size' => '500 g', 'price' => '₹40', 'img' => '/images/Carrot (Orange).jpeg'],

                        ['title' => 'Capsicum (Green)', 'size' => '250 g', 'price' => '₹35', 'img' => '/images/Capsicum (Green).jpeg'],

                         ['title' => 'Chili', 'size' => '250 g', 'price' => '₹30', 'img' => '\images\chilli.jpeg'],
                    ];
                @endphp
                @foreach($vegetables_products as $product)
                    <div class="swiper-slide">

                        <div
                            class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-all p-4 flex flex-col justify-between group h-full">
                            <!-- Image -->
                            <a href="{{ route('personal-products') }}" class="block group">
                                <div class="relative">
                                    <img src="{{ $product['img'] }}" alt="{{ $product['title'] }}"
                                        class="w-full h-32 object-contain mb-3 transition-transform duration-200 group-hover:scale-105"
                                        onerror="this.onerror=null;this.src='https://placehold.co/150x128/E0E0E0/666666?text=Image+Not+Found';">
                                    <!-- Delivery badge -->
                                    <div
                                        class="absolute top-0 left-0 bg-green-100 text-green-600 text-xs font-semibold px-2 py-0.5 rounded-br-md flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3" />
                                        </svg>
                                        8 MINS
                                    </div>
                                </div>
                            </a>
                            <!-- Product Info -->
                            <div class="flex-1 flex flex-col justify-between text-center">
                                <h3 class="text-base font-bold text-gray-800 line-clamp-2 leading-snug mb-1">
                                    {{ $product['title'] }}</h3>
                                <p class="text-sm text-gray-500 mb-2">{{ $product['size'] }}</p>
                            </div>
                            <!-- Price + Add Button -->
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-xl font-extrabold text-green-700">{{ $product['price'] }}</span>
                                <button onclick="event.stopPropagation(); window.location.href='{{ url('/cart') }}';"
                                    class="px-5 py-2 text-sm font-semibold rounded-lg border-2 border-green-600 text-green-700 bg-green-50 hover:bg-green-600 hover:text-white transition duration-300 ease-in-out shadow-sm">
                                    ADD
                                </button>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination mt-4"></div>
        </div>

        <!-- Fruits Section -->
        <div class="flex items-center justify-between mb-4" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800">Fresh Fruits</h2>
            <a href="{{ route('fruits') }}" class="text-green-600 font-semibold hover:underline text-lg">See All <i
                    class="fas fa-arrow-right ml-1"></i></a>
        </div>
        <div class="swiper productSwiper mb-10 p-2" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                @php
                    $fruits_products = [
                        ['title' => 'Bananas (Robusta)', 'size' => '1 dozen', 'price' => '₹48', 'img' => '\images\banana.jpeg'],

                        ['title' => 'Apples (Fuji)', 'size' => '4 pcs (approx 500 g)', 'price' => '₹110', 'img' => '\images\Apples (Fuji).jpg'],

                        ['title' => 'Oranges', 'size' => '1 kg', 'price' => '₹85', 'img' => '\images\Oranges.jpeg'],

                        ['title' => 'Grapes (Green)', 'size' => '500 g', 'price' => '₹55', 'img' => '\images\Grapes (Green).jpeg'],
                        
                        ['title' => 'Pomegranate', 'size' => '4 pcs (approx 700 g)', 'price' => '₹135', 'img' => '\images\Pomegranate.jpg'],

                        ['title' => 'pineapple', 'size' => '4 pcs (approx 700 g)', 'price' => '₹135', 'img' => '\images\pineapple.webp'],
                    ];
                @endphp
                @foreach($fruits_products as $product)
                    <div class="swiper-slide">

                        <div
                            class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-all p-4 flex flex-col justify-between group h-full">
                            <!-- Image -->
                            <a href="{{ route('personal-products') }}" class="block group">
                                <div class="relative">
                                    <img src="{{ $product['img'] }}" alt="{{ $product['title'] }}"
                                        class="w-full h-32 object-contain mb-3 transition-transform duration-200 group-hover:scale-105"
                                        onerror="this.onerror=null;this.src='https://placehold.co/150x128/E0E0E0/666666?text=Image+Not+Found';">
                                    <!-- Delivery badge -->
                                    <div
                                        class="absolute top-0 left-0 bg-green-100 text-green-600 text-xs font-semibold px-2 py-0.5 rounded-br-md flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3" />
                                        </svg>
                                        8 MINS
                                    </div>
                                </div>
                            </a>
                            <!-- Product Info -->
                            <div class="flex-1 flex flex-col justify-between text-center">
                                <h3 class="text-base font-bold text-gray-800 line-clamp-2 leading-snug mb-1">
                                    {{ $product['title'] }}</h3>
                                <p class="text-sm text-gray-500 mb-2">{{ $product['size'] }}</p>
                            </div>
                            <!-- Price + Add Button -->
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-xl font-extrabold text-green-700">{{ $product['price'] }}</span>
                                <button onclick="event.stopPropagation(); window.location.href='{{ url('/cart') }}';"
                                    class="px-5 py-2 text-sm font-semibold rounded-lg border-2 border-green-600 text-green-700 bg-green-50 hover:bg-green-600 hover:text-white transition duration-300 ease-in-out shadow-sm">
                                    ADD
                                </button>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination mt-4"></div>
        </div>

        <!-- Electronics Section -->
        <div class="flex items-center justify-between mb-4" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800">Electronics</h2>
            <a href="{{ route('electronics') }}" class="text-green-600 font-semibold hover:underline text-lg">See All <i
                    class="fas fa-arrow-right ml-1"></i></a>
        </div>
        <div class="swiper productSwiper mb-10 p-2" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                @php
                    $electronics_products = [
                        ['title' => 'Smartphone (Brand X)', 'size' => '6.1" Display, 128GB', 'price' => '₹15,999', 'img' => '\images\Smartphone (Brand X).jpg'],

                        ['title' => 'Wireless Headphones', 'size' => 'Noise Cancelling', 'price' => '₹4,499', 'img' => '\images\Wireless Headphones.png'],

                        ['title' => 'Smartwatch (Fitness Tracker)', 'size' => 'Heart Rate Monitor', 'price' => '₹2,999', 'img' => '\images\Smartwatch (Fitness Tracker).jpg'],
                        

                        ['title' => 'Portable Bluetooth Speaker', 'size' => 'Waterproof, 10W', 'price' => '₹1,899', 'img' => '\images\Portable Bluetooth Speaker.jpg'],

                        ['title' => 'Power Bank (10000 mAh)', 'size' => 'Fast Charging', 'price' => '₹999', 'img' => '\images\Power Bank (10000 mAh).jpeg'],

                        ['title' => 'Apple Airpods Pro', 'size' => 'Better Music', 'price' => '₹999', 'img' => '\images\apple airpodspro.jpeg'],
                    ];
                @endphp
                @foreach($electronics_products as $product)
                    <div class="swiper-slide">

                        <div
                            class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-all p-4 flex flex-col justify-between group h-full">
                            <!-- Image -->
                            <a href="{{ route('personal-products') }}" class="block group">
                                <div class="relative">
                                    <img src="{{ $product['img'] }}" alt="{{ $product['title'] }}"
                                        class="w-full h-32 object-contain mb-3 transition-transform duration-200 group-hover:scale-105"
                                        onerror="this.onerror=null;this.src='https://placehold.co/150x128/E0E0E0/666666?text=Image+Not+Found';">
                                    <!-- Delivery badge -->
                                    <div
                                        class="absolute top-0 left-0 bg-green-100 text-green-600 text-xs font-semibold px-2 py-0.5 rounded-br-md flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3" />
                                        </svg>
                                        8 MINS
                                    </div>
                                </div>
                            </a>
                            <!-- Product Info -->
                            <div class="flex-1 flex flex-col justify-between text-center">
                                <h3 class="text-base font-bold text-gray-800 line-clamp-2 leading-snug mb-1">
                                    {{ $product['title'] }}</h3>
                                <p class="text-sm text-gray-500 mb-2">{{ $product['size'] }}</p>
                            </div>
                            <!-- Price + Add Button -->
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-xl font-extrabold text-green-700">{{ $product['price'] }}</span>
                                <button onclick="event.stopPropagation(); window.location.href='{{ url('/cart') }}';"
                                    class="px-5 py-2 text-sm font-semibold rounded-lg border-2 border-green-600 text-green-700 bg-green-50 hover:bg-green-600 hover:text-white transition duration-300 ease-in-out shadow-sm">
                                    ADD
                                </button>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination mt-4"></div>
        </div>

        <!-- How Blingit Works Section -->
        <div class="bg-gray-50 p-8 rounded-2xl my-12" data-aos="fade-up">
            <h2 class="text-2xl font-bold mb-8 text-center text-gray-800" data-aos="fade-up">How Blingit Works</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="bg-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">1. Add Products</h3>
                    <p class="text-gray-600">Browse our fresh selection and add items to your cart</p>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="bg-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">2. Checkout Securely</h3>
                    <p class="text-gray-600">Complete your order with our safe payment options</p>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="bg-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">3. Fast Delivery</h3>
                    <p class="text-gray-600">Get your groceries delivered fresh to your doorstep</p>
                </div>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="bg-green-50 p-8 rounded-2xl my-12" data-aos="fade-up">
            <h2 class="text-2xl font-bold mb-8 text-center text-gray-800" data-aos="fade-up">Why Choose Blingit</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm flex items-start" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-green-100 p-3 rounded-full mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold mb-2">Fast Delivery</h3>
                        <p class="text-gray-600 text-sm">Get your order delivered in under 2 hours</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm flex items-start" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-green-100 p-3 rounded-full mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold mb-2">Quality Guarantee</h3>
                        <p class="text-gray-600 text-sm">100% fresh and high quality products</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm flex items-start" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-green-100 p-3 rounded-full mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold mb-2">Secure Payments</h3>
                        <p class="text-gray-600 text-sm">Multiple safe payment options</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm flex items-start" data-aos="fade-up" data-aos-delay="400">
                    <div class="bg-green-100 p-3 rounded-full mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold mb-2">24/7 Support</h3>
                        <p class="text-gray-600 text-sm">Dedicated customer care team</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize multiple Swiper instances
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Top Banner Swiper
            new Swiper('.topBannerSwiper', {
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.topBannerSwiper .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.topBannerSwiper .swiper-button-next',
                    prevEl: '.topBannerSwiper .swiper-button-prev',
                },
            });

            // Common Swiper configuration for products
            const swiperConfig = {
                slidesPerView: 1.2,
                spaceBetween: 20,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2.5,
                    },
                    768: {
                        slidesPerView: 3.5,
                    },
                    1024: {
                        slidesPerView: 5, // Show 5 products on larger screens
                    },
                },
            };

            // Initialize Swiper for each productSwiper instance
            const productSwipers = document.querySelectorAll('.productSwiper');
            productSwipers.forEach((swiperElement) => {
                // Get unique navigation and pagination elements for each swiper
                const config = {
                    ...swiperConfig,
                    navigation: {
                        nextEl: swiperElement.querySelector('.swiper-button-next'),
                        prevEl: swiperElement.querySelector('.swiper-button-prev'),
                    },
                    pagination: {
                        el: swiperElement.querySelector('.swiper-pagination'),
                        clickable: true,
                    }
                };
                new Swiper(swiperElement, config);
            });

            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 120,
                delay: 100
            });
        });
    </script>
@endsection