@extends('layout')

@section('title', 'Checkout | Blingit Grocery')

@section('content')
<!-- Razorpay Checkout Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<div class="bg-gray-50 min-h-screen font-sans">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="mb-8 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Secure Checkout</h1>
            <p class="mt-2 text-base text-gray-500">Complete your purchase by providing the details below.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12 items-start">
            
            <form id="checkout-form" method="POST" action="{{ route('checkout.place.order') }}" class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-200 p-6 sm:p-8">
                @csrf
                
                <section>
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        Contact Information
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" id="full_name" name="full_name" value="{{ old('full_name', Auth::user()->name) }}" class="w-full px-4 py-3 border @error('full_name') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                            @error('full_name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full px-4 py-3 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                            @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </section>

                <div class="border-t border-gray-200 my-8"></div>

                <section>
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2 2h8a1 1 0 001-1zM3 11h10" /></svg>
                        Shipping Address
                    </h2>
                    <div class="space-y-6">
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}" class="w-full px-4 py-3 border @error('address') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition" placeholder="123 Main St, Anytown">
                            @error('address')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                <input type="text" id="city" name="city" value="{{ old('city') }}" class="w-full px-4 py-3 border @error('city') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition" placeholder="Rajkot">
                                @error('city')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                <input type="text" id="state" name="state" value="{{ old('state') }}" class="w-full px-4 py-3 border @error('state') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition" placeholder="Gujarat">
                                @error('state')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="zip" class="block text-sm font-medium text-gray-700 mb-1">ZIP / Postal Code</label>
                                <input type="text" id="zip" name="zip" value="{{ old('zip') }}" class="w-full px-4 py-3 border @error('zip') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition" placeholder="360001">
                                @error('zip')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                </section>
                
                <div class="border-t border-gray-200 my-8"></div>

                <section>
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                        Payment Method
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 payment-options">
                        <label class="relative flex flex-col items-center justify-center p-4 rounded-xl border-2 @error('payment_method') border-red-500 @else border-gray-300 @enderror hover:border-green-500 transition cursor-pointer shadow-sm bg-white has-[:checked]:bg-green-50 has-[:checked]:border-green-600">
                            <input type="radio" name="payment_method" value="cod" class="absolute opacity-0 w-full h-full" @checked(old('payment_method', 'cod') == 'cod')>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            <span class="font-semibold text-gray-800 text-center">Cash on Delivery</span>
                        </label>
                        <label class="relative flex flex-col items-center justify-center p-4 rounded-xl border-2 @error('payment_method') border-red-500 @else border-gray-300 @enderror hover:border-green-500 transition cursor-pointer shadow-sm bg-white has-[:checked]:bg-green-50 has-[:checked]:border-green-600">
                            <input type="radio" name="payment_method" value="razorpay" class="absolute opacity-0 w-full h-full" @checked(old('payment_method') == 'razorpay')>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            <span class="font-semibold text-gray-800 text-center">Card, UPI & More</span>
                        </label>
                    </div>
                    @error('payment_method')<p class="text-red-600 text-sm mt-2 text-center">{{ $message }}</p>@enderror
                </section>
                
                <div class="mt-10">
                    <button id="placeOrderBtn" type="button" class="w-full bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-green-500/40 transition-all duration-300 ease-in-out transform hover:-translate-y-1 flex items-center justify-center gap-2">
                        <span>Place Order Securely</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </button>
                </div>
            </form>

            <div class="lg:col-span-1">
                <div class="sticky top-28 bg-white border border-gray-200 rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 border-b border-gray-200 pb-4 mb-4">Order Summary</h2>
                    
                    @php
                        $subtotal = 0;
                        foreach($cartItems as $item) {
                            $subtotal += $item->product->price * $item->quantity;
                        }
                        $discount = session()->get('coupon')['discount'] ?? 0;
                        $deliveryFee = ($subtotal - $discount) >= 500 ? 0 : 40;
                        $total = ($subtotal - $discount) + $deliveryFee;
                    @endphp

                    <div class="space-y-4 mb-6 max-h-64 overflow-y-auto pr-2">
                        @foreach($cartItems as $item)
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $item->product->image_url }}" class="w-14 h-14 object-cover rounded-lg border border-gray-200" alt="{{ $item->product->name }}">
                                <div>
                                    <p class="font-semibold text-gray-800 text-sm leading-tight">{{ $item->product->name }}</p>
                                    <p class="text-gray-500 text-xs">Qty: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <span class="font-bold text-gray-800 text-sm">₹{{ number_format($item->product->price * $item->quantity, 2) }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-6">
                        @if(!session()->has('coupon'))
                            <form action="{{ route('coupon.apply') }}" method="POST">
                                @csrf
                                <label for="coupon_code" class="block text-sm font-medium text-gray-700 mb-1">Discount Code</label>
                                <div class="flex gap-2">
                                    <input type="text" name="coupon_code" id="coupon_code" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-green-500" placeholder="Enter code">
                                    <button type="submit" class="px-4 py-2 bg-yellow-400 text-yellow-900 font-semibold rounded-lg hover:bg-yellow-500 transition">Apply</button>
                                </div>
                                @error('coupon_code')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                            </form>
                        @endif
                    </div>

                    <div class="border-t border-gray-200 pt-4 space-y-2">
                        <div class="flex justify-between text-base text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-medium">₹{{ number_format($subtotal, 2) }}</span>
                        </div>
                        @if(session()->has('coupon'))
                        <div class="flex justify-between text-base text-green-600">
                            <span>Discount ({{ session('coupon')['code'] }})</span>
                            <span class="font-medium">- ₹{{ number_format($discount, 2) }}</span>
                        </div>
                        <form action="{{ route('coupon.remove') }}" method="POST" class="text-right">
                            @csrf
                            <button type="submit" class="text-xs text-red-500 hover:underline">Remove Coupon</button>
                        </form>
                        @endif
                        <div class="flex justify-between text-base text-gray-600">
                            <span>Delivery Fee</span>
                            <span class="font-medium">₹{{ number_format($deliveryFee, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold text-gray-900 mt-2">
                            <span>Total</span>
                            <span class="text-green-700">₹{{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const placeOrderBtn = document.getElementById('placeOrderBtn');
    const checkoutForm = document.getElementById('checkout-form');
    
    placeOrderBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

        if (paymentMethod === 'cod') {
            checkoutForm.submit();
        } else if (paymentMethod === 'razorpay') {
            var options = {
                "key": "{{ config('services.razorpay.key_id') }}",
                "amount": "{{ $total * 100 }}",
                "currency": "INR",
                "name": "Blingit Grocery",
                "description": "Order Payment",
                "image": "https://i.ibb.co/60k5bC1/blingit-high-resolution-logo-transparent.png",
                "handler": function (response){
                    document.getElementById('checkout-form').insertAdjacentHTML('beforeend', `<input type="hidden" name="razorpay_payment_id" value="${response.razorpay_payment_id}">`);
                    document.getElementById('checkout-form').insertAdjacentHTML('beforeend', `<input type="hidden" name="razorpay_order_id" value="${response.razorpay_order_id}">`);
                    document.getElementById('checkout-form').insertAdjacentHTML('beforeend', `<input type="hidden" name="razorpay_signature" value="${response.razorpay_signature}">`);
                    checkoutForm.submit();
                },
                "prefill": {
                    "name": "{{ Auth::user()->name }}",
                    "email": "{{ Auth::user()->email }}",
                    "contact": ""
                },
                "theme": {
                    "color": "#22c55e"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){
                alert('Payment failed. Please try again. Error: ' + response.error.description);
            });
            rzp1.open();
        }
    });
});
</script>
@endsection

