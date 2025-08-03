@extends('layout')

@section('title', 'Login | Blingit Grocery')

@push('scripts')
<script type="module" src="https://cdn.skypack.dev/motion"></script>
<script src="{{ asset('js/login.js') }}"></script>
@endpush

@section('content')

@if (session('status'))
    <div class="max-w-md mx-auto mt-6">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-md" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline ml-1">{{ session('status') }}</span>
        </div>
    </div>
@endif

<div class="min-h-screen bg-gray-50 flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <div class="relative w-full max-w-6xl bg-white rounded-3xl shadow-2xl border border-gray-200 overflow-hidden grid grid-cols-1 lg:grid-cols-2">
        
        <!-- Left Column -->
        <div class="hidden lg:block relative bg-green-50 p-10" id="info-panel">
            <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('https://www.toptal.com/designers/subtlepatterns/uploads/leaves-3.png');"></div>
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div>
                    <a href="/" class="flex items-center gap-2 group mb-8">
                        <span class="text-3xl font-extrabold px-3 py-1 rounded-lg shadow-lg blingit-logo-text" style="background-color: #FFFF00;">
                            <span class="text-black">bling</span><span class="text-green-600">it</span>
                        </span>
                    </a>
                    <h2 class="text-4xl font-extrabold text-gray-800 leading-tight">
                        Groceries delivered to your doorstep, <span class="text-green-600">lightning fast.</span>
                    </h2>
                    <p class="mt-4 text-gray-600 text-lg">
                        Shop from a wide selection of fresh produce, pantry staples, and household essentials.
                    </p>
                </div>
                <div class="mt-10 space-y-6">
                    <div class="flex items-start gap-4 info-item">
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
                    <div class="flex items-start gap-4 info-item">
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

        <!-- Right Column -->
        <div class="p-8 sm:p-12 flex flex-col justify-center">
            <div class="w-full max-w-md mx-auto">
                <div class="text-center lg:text-left mb-8" id="form-header">
                    <a href="/" class="lg:hidden flex items-center justify-center gap-2 group mb-6">
                        <span class="text-3xl font-extrabold text-gray-900">
                            bling<span class="text-green-600">it</span>
                        </span>
                    </a>
                    <h1 class="text-3xl font-extrabold text-gray-900">Welcome Back!</h1>
                    <p class="text-gray-500 mt-1">Please enter your details to sign in.</p>
                </div>

                <form id="login-form" method="POST" action="/login" class="space-y-6" novalidate>
                    @csrf
                    <div>
                        <label for="login-email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </span>
                            <input type="email" id="login-email" name="email" value="{{ old('email') }}" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('email') border-red-500 @enderror" placeholder="you@example.com" required />
                        </div>
                        <span id="email-error" class="text-red-600 text-xs mt-1 h-4 block"></span>
                        @error('email')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label for="login-password" class="block text-sm font-medium text-gray-700">Password</label>
                            <a href="/forgot-password" class="text-sm font-medium text-green-600 hover:underline">Forgot Password?</a>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input type="password" id="login-password" name="password" class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('password') border-red-500 @enderror" placeholder="••••••••" required />
                            <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePasswordVisibility('login-password')">
                                <svg id="eye-icon-login-password" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </span>
                        </div>
                        <span id="password-error" class="text-red-600 text-xs mt-1 h-4 block"></span>
                        @error('password')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-0.5 text-lg">
                            Sign In
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <span class="text-gray-600">Don't have an account?</span>
                    <a href="/register" class="text-green-600 font-bold hover:underline ml-1">Register Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
