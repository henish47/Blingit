@extends('layout')

@section('title', 'About Us | Blingit Grocery')

@section('content')

<div class="bg-gray-50 font-sans">
    <!-- Header Section -->
    <div class="bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 tracking-tight">About <span class="text-green-600">Blingit</span></h1>
            <p class="mt-4 max-w-3xl mx-auto text-lg text-gray-600">
                We're on a mission to revolutionize your grocery shopping experience, one lightning-fast delivery at a time.
            </p>
        </div>
    </div>

    <!-- Our Story Section -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=2070&auto=format&fit=crop" 
                     alt="Fresh groceries in a basket" 
                     class="rounded-2xl shadow-lg w-full h-full object-cover">
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Story</h2>
                <p class="text-gray-600 mb-4">
                    Blingit started with a simple idea: what if getting fresh groceries was as easy as a few taps on your phone? We were tired of long queues, wasted time, and the hassle of traditional grocery shopping. So, we set out to build a service that combines the best of local, fresh produce with the convenience of modern technology.
                </p>
                <p class="text-gray-600">
                    From our humble beginnings, we've grown into a trusted name for thousands of families, all thanks to our commitment to quality, speed, and customer happiness.
                </p>
            </div>
        </div>
    </div>

    <!-- Mission & Values Section -->
    <div class="bg-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Our Mission & Values</h2>
                <p class="mt-2 text-gray-600">What drives us every day.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Mission Card -->
                <div class="text-center p-6 bg-gray-50 rounded-2xl border border-gray-200">
                    <div class="bg-green-100 p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Our Mission</h3>
                    <p class="text-gray-600">To deliver quality groceries at lightning speed, with a smile. We believe in supporting local farmers and making healthy food accessible to everyone.</p>
                </div>
                <!-- Vision Card -->
                <div class="text-center p-6 bg-gray-50 rounded-2xl border border-gray-200">
                    <div class="bg-green-100 p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Our Vision</h3>
                    <p class="text-gray-600">To be the most loved and trusted grocery delivery service, creating a sustainable future for food and our communities.</p>
                </div>
                <!-- Values Card -->
                <div class="text-center p-6 bg-gray-50 rounded-2xl border border-gray-200">
                    <div class="bg-green-100 p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Our Values</h3>
                    <ul class="text-gray-600 space-y-1">
                        <li>Freshness First</li>
                        <li>Customer Delight</li>
                        <li>Sustainability</li>
                        <li>Community Support</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Meet the Team Section -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">Meet the Team</h2>
            <p class="mt-2 text-gray-600">The people behind your fresh groceries.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <img src="https://ui-avatars.com/api/?name=Aarav+Patel&size=128&background=22c55e&color=fff" class="w-32 h-32 rounded-full mx-auto mb-4 shadow-lg" alt="Aarav Patel">
                <h3 class="text-xl font-bold text-gray-800">Aarav Patel</h3>
                <p class="text-gray-500">Founder & CEO</p>
            </div>
            <div class="text-center">
                <img src="https://ui-avatars.com/api/?name=Sneha+Mehta&size=128&background=22c55e&color=fff" class="w-32 h-32 rounded-full mx-auto mb-4 shadow-lg" alt="Sneha Mehta">
                <h3 class="text-xl font-bold text-gray-800">Sneha Mehta</h3>
                <p class="text-gray-500">Head of Operations</p>
            </div>
            <div class="text-center">
                <img src="https://ui-avatars.com/api/?name=Vikram+Singh&size=128&background=22c55e&color=fff" class="w-32 h-32 rounded-full mx-auto mb-4 shadow-lg" alt="Vikram Singh">
                <h3 class="text-xl font-bold text-gray-800">Vikram Singh</h3>
                <p class="text-gray-500">Chief Technology Officer</p>
            </div>
            <div class="text-center">
                <img src="https://ui-avatars.com/api/?name=Priya+Verma&size=128&background=22c55e&color=fff" class="w-32 h-32 rounded-full mx-auto mb-4 shadow-lg" alt="Priya Verma">
                <h3 class="text-xl font-bold text-gray-800">Priya Verma</h3>
                <p class="text-gray-500">Head of Customer Happiness</p>
            </div>
        </div>
    </div>
    
    <!-- What Our Customers Say Section -->
    @if(isset($reviews) && $reviews->isNotEmpty())
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">What Our Customers Say</h2>
            <p class="mt-2 text-gray-600">Real feedback from our happy customers.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($reviews as $review)
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 flex flex-col">
                <div class="flex-grow">
                    <div class="flex items-center mb-3">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 {{ $i < $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 italic">"{{ $review->comment }}"</p>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center gap-3">
                    <img src="{{ $review->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($review->user->name).'&color=FFFFFF&background=10B981' }}" class="w-10 h-10 rounded-full object-cover" alt="{{ $review->user->name }}">
                    <div>
                        <div class="font-bold text-gray-800">{{ $review->user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

