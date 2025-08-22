@extends('layout')

@section('title', 'Register | Blingit Grocery')

@push('scripts')
<script type="module" src="https://cdn.skypack.dev/motion"></script>
<script src="{{ asset('js/register.js') }}"></script>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl border border-gray-200 overflow-hidden grid grid-cols-1 lg:grid-cols-2">
        
        <!-- Left Panel -->
        <div class="hidden lg:block relative bg-green-50 p-10">
            <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('https://www.toptal.com/designers/subtlepatterns/uploads/leaves-3.png');"></div>
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div>
                    <a href="/" class="flex items-center gap-2 mb-8">
                        <span class="text-3xl font-extrabold px-3 py-1 rounded-lg shadow-lg blingit-logo-text" style="background-color: #FFFF00;">
                            <span class="text-black">bling</span><span class="text-green-600">it</span>
                        </span>
                    </a>
                    <h2 class="text-4xl font-extrabold text-gray-800">Join the fastest grocery delivery <span class="text-green-600">in town.</span></h2>
                    <p class="mt-4 text-gray-600 text-lg">Create an account to enjoy exclusive deals, faster checkouts, and a personalized shopping experience.</p>
                </div>
                <div class="mt-10 space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">10-Minute Delivery</h3>
                            <p class="text-gray-600">Why wait? Get your order in minutes.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Freshness Guaranteed</h3>
                            <p class="text-gray-600">We pick only the best for you.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel: Form -->
        <div class="p-8 sm:p-12 flex flex-col justify-center">
            <div class="w-full max-w-md mx-auto">
                <div class="text-center lg:text-left mb-8">
                    <a href="/" class="lg:hidden flex items-center justify-center gap-2 mb-6">
                        <span class="text-3xl font-extrabold text-gray-900">bling<span class="text-green-600">it</span></span>
                    </a>
                    <h1 class="text-3xl font-extrabold text-gray-900">Create an Account</h1>
                    <p class="text-gray-500 mt-1">Let's get you started with fresh groceries.</p>
                </div>

                @if(session('message'))
                    <div class="mb-4 text-green-600 font-semibold text-sm">
                        {{ session('message') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-5" novalidate>
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="John Doe" required>
                        @error('name')<span class="text-red-600 text-xs mt-1">{{ $message }}</span>@enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="you@example.com" required>
                        @error('email')<span class="text-red-600 text-xs mt-1">{{ $message }}</span>@enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-3 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="••••••••" required>
                        @error('password')<span class="text-red-600 text-xs mt-1">{{ $message }}</span>@enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-3 border @error('password_confirmation') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="••••••••" required>
                        @error('password_confirmation')<span class="text-red-600 text-xs mt-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition-all duration-300">
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <span class="text-gray-600">Already have an account?</span>
                    <a href="{{ route('login') }}" class="text-green-600 font-bold hover:underline ml-1">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
