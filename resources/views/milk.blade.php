@extends('layout')

@section('title', 'Dairy & Eggs | Blingit Grocery')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Dairy & Eggs Header -->
    <div class="flex items-center justify-between mb-6" data-aos="fade-up">
        <h2 class="text-4xl font-extrabold text-gray-800">Dairy & Eggs</h2>
    </div>

    <!-- Dairy & Eggs Product Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6" data-aos="fade-up" data-aos-delay="100">
        @php
            $dairy_products = [
                ['title' => 'Amul Gold Full Cream Milk', 'size' => '500 ml', 'price' => '₹34', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/1203470_2-amul-gold-homogenised-standardised-milk.jpg'],
                ['title' => 'Amul Taaza Toned Milk', 'size' => '1 L', 'price' => '₹54', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/1203620_2-amul-taaza-homogenised-toned-milk.jpg'],
                ['title' => 'Mother Dairy Curd', 'size' => '400 g', 'price' => '₹30', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000241_14-mother-dairy-dahi.jpg'],
                ['title' => 'Amul Butter', 'size' => '500 g', 'price' => '₹265', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000298_16-amul-butter-pasteurised.jpg'],
                ['title' => 'Heritage Paneer', 'size' => '200 g', 'price' => '₹75', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/1201555_2-heritage-paneer-fresh.jpg'],
                ['title' => 'Eggs Regular (White)', 'size' => '6 pcs', 'price' => '₹40', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000944_2-fresho-eggs-regular.jpg'],
                ['title' => 'Country Eggs (Brown)', 'size' => '6 pcs', 'price' => '₹68', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/1204151_2-fresho-country-eggs-medium-antibiotic-residue-free.jpg'],
                ['title' => 'Nestle Milkmaid', 'size' => '400 g', 'price' => '₹135', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10001112_11-nestle-milkmaid-sweetened-condensed-milk.jpg'],
                ['title' => 'Britannia Cheese Slices', 'size' => '200 g', 'price' => '₹110', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000057_10-britannia-cheese-slices.jpg'],
                ['title' => 'Go Plain Cheese Cubes', 'size' => '200 g', 'price' => '₹105', 'img' => 'https://www.bigbasket.com/media/uploads/p/l/20000780_1-go-cheese-cubes-plain.jpg'],
            ];
        @endphp

        @foreach($dairy_products as $product)
        
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
