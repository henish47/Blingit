@extends('layout')

@section('title', 'Checkout | Blingit Grocery')

@section('content')

<div class="bg-gray-50 min-h-screen font-sans">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Page Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                Secure Checkout
            </h1>
            <p class="mt-2 text-base text-gray-500">Complete your purchase by providing the details below.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12 items-start">
            
            <!-- Left Column: Shipping & Payment Form -->
            <form id="checkout-form" class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-200 p-6 sm:p-8" novalidate>
                
                <!-- Contact Information Section -->
                <section>
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        Contact Information
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" id="full_name" name="full_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" placeholder="Your Name">
                            <p id="full_name_error" class="text-red-600 text-xs mt-1 h-4"></p>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" placeholder="you@example.com">
                            <p id="email_error" class="text-red-600 text-xs mt-1 h-4"></p>
                        </div>
                    </div>
                </section>

                <div class="border-t border-gray-200 my-8"></div>

                <!-- Shipping Details Section -->
                <section>
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2 2h8a1 1 0 001-1zM3 11h10" /></svg>
                        Shipping Address
                    </h2>
                    <div class="space-y-6">
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <input type="text" id="address" name="address" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" placeholder="123 Main St, Anytown">
                            <p id="address_error" class="text-red-600 text-xs mt-1 h-4"></p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                <input type="text" id="city" name="city" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" placeholder="Rajkot">
                                <p id="city_error" class="text-red-600 text-xs mt-1 h-4"></p>
                            </div>
                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                <input type="text" id="state" name="state" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" placeholder="Gujarat">
                                <p id="state_error" class="text-red-600 text-xs mt-1 h-4"></p>
                            </div>
                            <div>
                                <label for="zip" class="block text-sm font-medium text-gray-700 mb-1">ZIP / Postal Code</label>
                                <input type="text" id="zip" name="zip" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" placeholder="360001">
                                <p id="zip_error" class="text-red-600 text-xs mt-1 h-4"></p>
                            </div>
                        </div>
                    </div>
                </section>
                
                <div class="border-t border-gray-200 my-8"></div>

                <!-- Payment Method Section -->
                <section>
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                        Payment Method
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 payment-options">
                        <label class="relative flex flex-col items-center justify-center p-4 rounded-xl border-2 border-gray-300 hover:border-green-500 transition cursor-pointer shadow-sm bg-white has-[:checked]:bg-green-50 has-[:checked]:border-green-600">
                            <input type="radio" name="payment_method" value="cod" class="absolute opacity-0 w-full h-full">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            <span class="font-semibold text-gray-800 text-center">Cash on Delivery</span>
                        </label>
                        <label class="relative flex flex-col items-center justify-center p-4 rounded-xl border-2 border-gray-300 hover:border-green-500 transition cursor-pointer shadow-sm bg-white has-[:checked]:bg-green-50 has-[:checked]:border-green-600">
                            <input type="radio" name="payment_method" value="razorpay" class="absolute opacity-0 w-full h-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            <span class="font-semibold text-gray-800 text-center">Card, UPI & More</span>
                        </label>
                    </div>
                     <p id="payment_method_error" class="text-red-600 text-sm mt-2 text-center h-4"></p>
                </section>
                
                <div class="mt-10">
                    <button id="placeOrderBtn" type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-green-500/40 transition-all duration-300 ease-in-out transform hover:-translate-y-1 flex items-center justify-center gap-2">
                        <span>Place Order Securely</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </button>
                </div>
            </form>

            <!-- Right Column: Order Summary -->
            <div class="lg:col-span-1">
                <div class="sticky top-28 bg-white border border-gray-200 rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 border-b border-gray-200 pb-4 mb-4">Order Summary</h2>
                    
                    <!-- Product List -->
                    <div class="space-y-4 mb-6 max-h-64 overflow-y-auto pr-2">
                        @php
                            // Mock data for summary. In a real app, this would come from the cart session.
                            $summaryItems = [
                                ['img' => '\images\amulgold.avif', 'name' => 'Amul Gold Milk', 'qty' => 2, 'price' => 68],
                                ['img' => '\images\banana.jpeg', 'name' => 'Banana (1 dozen)', 'qty' => 1, 'price' => 60],
                                ['img' => '\images\onion.webp', 'name' => 'Fresh Onion', 'qty' => 3, 'price' => 120],
                            ];
                            $subtotal = array_sum(array_column($summaryItems, 'price'));
                            $deliveryFee = 40.00;
                            $total = $subtotal + $deliveryFee;
                        @endphp

                        @foreach($summaryItems as $item)
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $item['img'] }}" class="w-14 h-14 object-cover rounded-lg border border-gray-200" alt="{{ $item['name'] }}" onerror="this.onerror=null;this.src='https://placehold.co/56x56/f0f0f0/999999?text=Img';">
                                <div>
                                    <p class="font-semibold text-gray-800 text-sm leading-tight">{{ $item['name'] }}</p>
                                    <p class="text-gray-500 text-xs">Qty: {{ $item['qty'] }}</p>
                                </div>
                            </div>
                            <span class="font-bold text-gray-800 text-sm">₹{{ number_format($item['price'], 2) }}</span>
                        </div>
                        @endforeach
                    </div>

                    <!-- Discount Code -->
                    <div class="mb-6">
                        <label for="discount_code" class="block text-sm font-medium text-gray-700 mb-1">Discount Code (Optional)</label>
                        <div class="flex gap-2">
                            <input type="text" id="discount_code" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 transition" placeholder="Enter code">
                            <button class="px-4 py-2 bg-green-400 text-gray-700 font-semibold rounded-lg hover:bg-yellow-300 transition">Apply</button>
                        </div>
                    </div>

                    <!-- Totals -->
                    <div class="border-t border-gray-200 pt-4 space-y-2">
                        <div class="flex justify-between text-base text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-medium">₹{{ number_format($subtotal, 2) }}</span>
                        </div>
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
    const form = document.getElementById('checkout-form');
    
    // Map of input IDs to their validation functions
    const validators = {
        'full_name': validateTextOnly,
        'email': validateEmail,
        'address': validateAddress,
        'city': validateTextOnly,
        'state': validateTextOnly,
        'zip': validateZip,
    };

    // --- Helper Functions ---
    const showError = (input, message) => {
        const errorElement = document.getElementById(input.id + '_error');
        input.classList.add('border-red-500');
        input.classList.remove('border-gray-300');
        errorElement.textContent = message;
    };

    const clearError = (input) => {
        const errorElement = document.getElementById(input.id + '_error');
        input.classList.remove('border-red-500');
        input.classList.add('border-gray-300');
        if (errorElement) {
            errorElement.textContent = '';
        }
    };

    // --- Individual Validation Functions ---
    function validateRequired(input) {
        if (input.value.trim() === '') {
            showError(input, `${input.labels[0].textContent} is required.`);
            return false;
        }
        clearError(input);
        return true;
    }

    function validateTextOnly(input) {
        if (!validateRequired(input)) return false;
        const nameRegex = /^[a-zA-Z\s.'-]+$/;
        if (!nameRegex.test(input.value)) {
            showError(input, 'This field cannot contain numbers or invalid special characters.');
            return false;
        }
        clearError(input);
        return true;
    }

    function validateEmail(input) {
        if (!validateRequired(input)) return false;
        const emailRegex = /^\S+@\S+\.\S+$/;
        if (!emailRegex.test(input.value)) {
            showError(input, 'Please enter a valid email address.');
            return false;
        }
        clearError(input);
        return true;
    }
    
    function validateAddress(input) {
        if (!validateRequired(input)) return false;
        if (input.value.trim().length < 10) {
            showError(input, 'Please enter a more detailed address (at least 10 characters).');
            return false;
        }
        clearError(input);
        return true;
    }

    function validateZip(input) {
        if (!validateRequired(input)) return false;
        const zipRegex = /^\d{6}$/;
        if (!zipRegex.test(input.value.trim())) {
            showError(input, 'Please enter a valid 6-digit PIN code.');
            return false;
        }
        clearError(input);
        return true;
    }
    
    function validatePaymentMethod() {
        const paymentMethod = form.querySelector('input[name="payment_method"]:checked');
        const paymentError = document.getElementById('payment_method_error');
        const paymentOptionsLabels = form.querySelectorAll('.payment-options label');

        if (!paymentMethod) {
            paymentError.textContent = 'Please select a payment method.';
            paymentOptionsLabels.forEach(label => {
                label.classList.add('border-red-500');
                label.classList.remove('border-gray-300');
            });
            return false;
        }
        
        paymentError.textContent = '';
        paymentOptionsLabels.forEach(label => {
            label.classList.remove('border-red-500');
            // Let the :checked pseudo-class handle the green border, otherwise set to gray
            if (!label.querySelector('input').checked) {
                 label.classList.add('border-gray-300');
            }
        });
        return true;
    }

    // --- Main Form Validation Trigger ---
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let isFormValid = true;
        
        // Validate all text/email inputs
        Object.keys(validators).forEach(id => {
            const input = document.getElementById(id);
            if (!validators[id](input)) {
                isFormValid = false;
            }
        });

        // Validate payment method
        if (!validatePaymentMethod()) {
            isFormValid = false;
        }

        if (isFormValid) {
            console.log('Form is valid. Submitting...');
            window.location.href = '/place-order'; 
        } else {
            console.log('Form is invalid. Please correct the errors.');
            const firstError = form.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
    
    // --- Real-time Validation ---
    Object.keys(validators).forEach(id => {
        const input = document.getElementById(id);
        input.addEventListener('input', () => validators[id](input));
    });
    
    form.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', validatePaymentMethod);
    });
});
</script>
@endsection
