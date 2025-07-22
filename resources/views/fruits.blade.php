@extends('layout')

@section('title', 'Fruits | Blingit Grocery')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Fruits Header -->
    <div class="flex items-center justify-between mb-6" data-aos="fade-up">
        <h2 class="text-4xl font-extrabold text-gray-800">Fresh Fruits</h2>
    </div>

    <!-- Search Bar -->
    <div class="mb-8" data-aos="fade-up" data-aos-delay="50">
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                <i class="fa fa-search text-green-500 text-lg"></i>
            </div>
            <input type="text" placeholder="Search for your favorite fruits..."
                class="w-full pl-10 pr-4 py-3 rounded-xl border border-green-300 focus:outline-none focus:ring-2 focus:ring-green-400 bg-white shadow-lg text-base transition focus:shadow-xl" />
        </div>
    </div>

    <!-- Fruits Product Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6" data-aos="fade-up" data-aos-delay="100">
        @php
            $fruits = [
                ['title' => 'Bananas (Robusta)', 'size' => '1 dozen', 'price' => '₹48', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000025_14-fresho-banana-robusta.jpg'],
                ['title' => 'Apples (Fuji)', 'size' => '4 pcs (approx 500 g)', 'price' => '₹110', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/1203432_2-fresho-apple-fuji.jpg'],
                ['title' => 'Oranges', 'size' => '1 kg', 'price' => '₹85', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000145_20-fresho-orange.jpg'],
                ['title' => 'Grapes (Green)', 'size' => '500 g', 'price' => '₹55', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000139_15-fresho-grapes-green-seedless.jpg'],
                ['title' => 'Pomegranate', 'size' => '4 pcs (approx 700 g)', 'price' => '₹135', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000087_15-fresho-pomegranate.jpg'],
                ['title' => 'Papaya', 'size' => '1 pc (800 g – 1.2 kg)', 'price' => '₹60', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000097_14-fresho-papaya.jpg'],
                ['title' => 'Mangoes (Alphonso)', 'size' => '1 kg', 'price' => '₹180', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/40220890_1-fresho-mango-alphonso-ratnagiri-premium.jpg'],
                ['title' => 'Kiwi (Imported)', 'size' => '3 pcs', 'price' => '₹90', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000277_16-fresho-kiwi-green.jpg'],
                ['title' => 'Strawberries', 'size' => '250 g', 'price' => '₹99', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000293_18-fresho-strawberry.jpg'],
                ['title' => 'Pineapple', 'size' => '1 pc (approx 1.2 kg)', 'price' => '₹70', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000257_17-fresho-pineapple.jpg'],
            ];
        @endphp

        @foreach($fruits as $product)
        
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
