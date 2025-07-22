@extends('layout')

@section('title', 'Home | Blingit Grocery')

@section('content')

<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<!-- SwiperJS CDN for Carousel -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<style>
    /* Custom styles for Swiper navigation and pagination */
    .swiper-button-next,
    .swiper-button-prev {
        color: #22c55e; /* Green color for arrows */
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        width: 40px;
        height: 40px;
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
        font-size: 18px !important; /* Adjust arrow size */
        font-weight: bold;
    }

    .swiper-pagination-bullet {
        background-color: #a1ffce !important; /* Light green for inactive dots */
        opacity: 1 !important;
        transition: all 0.3s ease-in-out;
    }

    .swiper-pagination-bullet-active {
        background-color: #22c55e !important; /* Darker green for active dot */
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
    <!-- Bootstrap Carousel (Top Banner) -->
    <div id="topBannerCarousel" class="carousel slide mb-10 rounded-2xl overflow-hidden shadow-xl" data-bs-ride="carousel" data-aos="fade-up">
        <div class="carousel-inner">
            @php
            $banners = [
                'https://via.placeholder.com/1200x300/A1FFCE/166534?text=Fresh+Groceries+Delivered',
                'https://via.placeholder.com/1200x300/FBBF24/166534?text=Daily+Deals+and+Offers',
                'https://via.placeholder.com/1200x300/FAFFD1/166534?text=Quality+You+Can+Trust',
            ];
            @endphp
            @foreach($banners as $index => $banner)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ $banner }}" class="d-block w-100 object-cover" style="height: 300px;" alt="Banner {{ $index + 1 }}">
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#topBannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#topBannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Milk & Eggs Section -->
    <div class="flex items-center justify-between mb-4" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800">Milk Eggs</h2>
        <a href="{{ route('milk') }}" class="text-green-600 font-semibold hover:underline text-lg">See All <i class="fas fa-arrow-right ml-1"></i></a>
    </div>
    <div class="swiper productSwiper mb-10 p-2" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">
            @php
                $milk_eggs_products = [
                    ['title' => 'Amul Gold Full Cream Milk', 'size' => '500 ml', 'price' => '₹34', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/1203470_2-amul-gold-homogenised-standardised-milk.jpg'],
                    ['title' => 'Amul Taaza Toned Milk', 'size' => '1 L', 'price' => '₹54', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/241600_7-amul-taaza-toned-milk.jpg'],
                    ['title' => 'Country Fresh Eggs', 'size' => '12 pcs', 'price' => '₹89', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/1203454_2-eggs-fresho-farm-eggs-table-white-medium-antibiotic-residue-free.jpg'],
                    ['title' => 'Nestle Milkmaid', 'size' => '400g Tin', 'price' => '₹135', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/1202664_3-nestle-milkmaid-sweetened-condensed-milk.jpg'],
                    ['title' => 'Mother Dairy Curd', 'size' => '400 g', 'price' => '₹30', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000241_14-mother-dairy-dahi.jpg'],
                    ['title' => 'Amul Butter', 'size' => '500 g', 'price' => '₹265', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000298_16-amul-butter-pasteurised.jpg'],
                ];
            @endphp
            @foreach($milk_eggs_products as $product)
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
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination mt-4"></div>
    </div>

    <!-- Vegetables Section -->
    <div class="flex items-center justify-between mb-4" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800">Fresh Vegetables</h2>
        <a href="{{ route('vegetables') }}" class="text-green-600 font-semibold hover:underline text-lg">See All <i class="fas fa-arrow-right ml-1"></i></a>
    </div>
    <div class="swiper productSwiper mb-10 p-2" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">
            @php
                $vegetables_products = [
                    ['title' => 'Onion', 'size' => '1 kg', 'price' => '₹30', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000150_19-fresho-onion.jpg'],
                    ['title' => 'Potato', 'size' => '1 kg', 'price' => '₹25', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000159_27-fresho-potato.jpg'],
                    ['title' => 'Tomato (Hybrid)', 'size' => '500 g', 'price' => '₹20', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000203_16-fresho-tomato-hybrid.jpg'],
                    ['title' => 'Carrot (Orange)', 'size' => '500 g', 'price' => '₹40', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000073_16-fresho-carrot-orange.jpg'],
                    ['title' => 'Capsicum (Green)', 'size' => '250 g', 'price' => '₹35', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000067_17-fresho-capsicum-green.jpg'],
                ];
            @endphp
            @foreach($vegetables_products as $product)
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
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination mt-4"></div>
    </div>

    <!-- Fruits Section -->
    <div class="flex items-center justify-between mb-4" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800">Fresh Fruits</h2>
        <a href="{{ route('fruits') }}" class="text-green-600 font-semibold hover:underline text-lg">See All <i class="fas fa-arrow-right ml-1"></i></a>
    </div>
    <div class="swiper productSwiper mb-10 p-2" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">
            @php
                $fruits_products = [
                    ['title' => 'Bananas (Robusta)', 'size' => '1 dozen', 'price' => '₹48', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000025_14-fresho-banana-robusta.jpg'],
                    ['title' => 'Apples (Fuji)', 'size' => '4 pcs (approx 500 g)', 'price' => '₹110', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/1203432_2-fresho-apple-fuji.jpg'],
                    ['title' => 'Oranges', 'size' => '1 kg', 'price' => '₹85', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000145_20-fresho-orange.jpg'],
                    ['title' => 'Grapes (Green)', 'size' => '500 g', 'price' => '₹55', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000139_15-fresho-grapes-green-seedless.jpg'],
                    ['title' => 'Pomegranate', 'size' => '4 pcs (approx 700 g)', 'price' => '₹135', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000087_15-fresho-pomegranate.jpg'],
                ];
            @endphp
            @foreach($fruits_products as $product)
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
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination mt-4"></div>
    </div>

    <!-- Electronics Section -->
    <div class="flex items-center justify-between mb-4" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800">Electronics</h2>
        <a href="{{ route('electronics') }}" class="text-green-600 font-semibold hover:underline text-lg">See All <i class="fas fa-arrow-right ml-1"></i></a>
    </div>
    <div class="swiper productSwiper mb-10 p-2" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">
            @php
                $electronics_products = [
                    ['title' => 'Smartphone (Brand X)', 'size' => '6.1" Display, 128GB', 'price' => '₹15,999', 'img' => 'https://m.media-amazon.com/images/I/71V--WWM-UL._AC_UF894,1000_QL80_.jpg'],
                    ['title' => 'Wireless Headphones', 'size' => 'Noise Cancelling', 'price' => '₹4,499', 'img' => 'https://m.media-amazon.com/images/I/61+HMj9+zBL._AC_UF894,1000_QL80_.jpg'],
                    ['title' => 'Smartwatch (Fitness Tracker)', 'size' => 'Heart Rate Monitor', 'price' => '₹2,999', 'img' => 'https://m.media-amazon.com/images/I/71LqS4-t+bL._AC_UF894,1000_QL80_.jpg'],
                    ['title' => 'Portable Bluetooth Speaker', 'size' => 'Waterproof, 10W', 'price' => '₹1,899', 'img' => 'https://m.media-amazon.com/images/I/71u9sW48zOL._AC_UF894,1000_QL80_.jpg'],
                    ['title' => 'Power Bank (10000 mAh)', 'size' => 'Fast Charging', 'price' => '₹999', 'img' => 'https://m.media-amazon.com/images/I/61r590h9kCL._AC_UF894,1000_QL80_.jpg'],
                ];
            @endphp
            @foreach($electronics_products as $product)
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
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination mt-4"></div>
    </div>

    <!-- How Blingit Works Section -->
    <div class="bg-gray-50 p-8 rounded-2xl my-12" data-aos="fade-up">
        <h2 class="text-2xl font-bold mb-8 text-center text-gray-800" data-aos="fade-up">How Blingit Works</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">1. Add Products</h3>
                <p class="text-gray-600">Browse our fresh selection and add items to your cart</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">2. Checkout Securely</h3>
                <p class="text-gray-600">Complete your order with our safe payment options</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold mb-2">Fast Delivery</h3>
                    <p class="text-gray-600 text-sm">Get your order delivered in under 2 hours</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm flex items-start" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-green-100 p-3 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold mb-2">Quality Guarantee</h3>
                    <p class="text-gray-600 text-sm">100% fresh and high quality products</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm flex items-start" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-green-100 p-3 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold mb-2">Secure Payments</h3>
                    <p class="text-gray-600 text-sm">Multiple safe payment options</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm flex items-start" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-green-100 p-3 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
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
    document.addEventListener('DOMContentLoaded', function() {
        // Common Swiper configuration
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
                    slidesPerView: 4,
                },
            },
        };

        // Initialize Swiper for each productSwiper instance
        const productSwipers = document.querySelectorAll('.productSwiper');
        productSwipers.forEach((swiperElement) => {
            new Swiper(swiperElement, swiperConfig);
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
