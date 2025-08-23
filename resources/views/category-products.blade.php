@extends('layout')

@section('title', $category->name . ' | Blingit Grocery')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <!-- Category Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800">{{ $category->name }}</h1>
            <p class="mt-2 text-lg text-gray-500">Browse all products in the {{ strtolower($category->name) }} category.</p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-10">
            @forelse($products as $product)
                <div class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-all p-4 flex flex-col justify-between group h-full">
                    {{-- Updated the link to point to the dynamic product page --}}
                    <a href="{{ route('product.show', $product) }}" class="block group">
                        <div class="relative">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                 class="w-full h-32 object-contain mb-3 transition-transform duration-200 group-hover:scale-105"
                                 onerror="this.onerror=null;this.src='https://placehold.co/150x128/E0E0E0/666666?text=Image+Not+Found';">
                        </div>
                    </a>
                    <div class="flex-1 flex flex-col justify-between text-center">
                        <h3 class="text-base font-bold text-gray-800 line-clamp-2 leading-snug mb-1">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500 mb-2 truncate">{{ $product->description }}</p>
                    </div>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-xl font-extrabold text-green-700">₹{{ number_format($product->price, 2) }}</span>
                        {{-- Corrected Add to Cart button logic --}}
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
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-xl">No products found in this category yet.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
@endsection
