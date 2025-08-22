@extends('layout')

@section('title', 'Product Details | Blingit Grocery')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="flex flex-col md:flex-row gap-10">
        <div class="flex-1 flex justify-center items-center">
            <img src="https://www.bigbasket.com/media/uploads/p/l/1203470_2-amul-gold-homogenised-standardised-milk.jpg" class="w-64 h-64 object-contain rounded-lg shadow" alt="Amul Gold Milk">
        </div>
        <div class="flex-1">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Amul Gold Full Cream Milk</h1>
            <div class="text-gray-500 mb-4">500 ml</div>
            <div class="text-2xl font-bold text-green-700 mb-4">₹34</div>
            <p class="mb-6 text-gray-700">Rich and creamy full cream milk from Amul. Perfect for tea, coffee, and direct consumption. Delivered fresh to your doorstep.</p>
            <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded font-semibold">Add to Cart</button>
        </div>
    </div>
    <div class="mt-12">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Related Products</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                <img src="https://www.bigbasket.com/media/uploads/p/l/40075561_2-fresho-banana-robusta.jpg" class="w-20 h-20 object-contain mb-2" alt="Banana">
                <div class="font-semibold text-gray-700 mb-1">Banana Robusta</div>
                <div class="font-bold text-green-700 mb-2">₹45</div>
                <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">Add</button>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                <img src="https://www.bigbasket.com/media/uploads/p/l/10000263_15-fresho-onion.jpg" class="w-20 h-20 object-contain mb-2" alt="Onion">
                <div class="font-semibold text-gray-700 mb-1">Fresh Onion</div>
                <div class="font-bold text-green-700 mb-2">₹30</div>
                <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">Add</button>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                <img src="https://www.bigbasket.com/media/uploads/p/l/10000331_14-fresho-tomato-hybrid.jpg" class="w-20 h-20 object-contain mb-2" alt="Tomato">
                <div class="font-semibold text-gray-700 mb-1">Tomato Hybrid</div>
                <div class="font-bold text-green-700 mb-2">₹28</div>
                <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">Add</button>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                <img src="https://www.bigbasket.com/media/uploads/p/l/1203470_2-amul-gold-homogenised-standardised-milk.jpg" class="w-20 h-20 object-contain mb-2" alt="Amul Gold Milk">
                <div class="font-semibold text-gray-700 mb-1">Amul Gold Milk</div>
                <div class="font-bold text-green-700 mb-2">₹34</div>
                <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">Add</button>
            </div>
        </div>
    </div>
</div>
@endsection 