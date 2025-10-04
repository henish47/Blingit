@extends('layout')

@section('title', 'Order Placed | Blingit Grocery')

@section('content')

<style>
    /* Custom CSS for enhanced UI and animations */
    .review-card, .review-success {
        transition: all 0.5s ease-in-out;
    }
    .star-rating {
        display: inline-flex;
        flex-direction: row-reverse; /* Stars ne ulta क्रम ma muko */
        font-size: 2.5rem;
        justify-content: center;
    }
    .star-rating input { display: none; }
    .star-rating label {
        color: #d1d5db; /* Gray color for empty stars */
        cursor: pointer;
        transition: color 0.2s;
    }
    .star-rating input:checked ~ label,
    .star-rating:not(:checked) > label:hover,
    .star-rating:not(:checked) > label:hover ~ label {
        color: #f59e0b; /* Yellow color for selected/hovered stars */
    }
    .animate-check {
        stroke-dasharray: 1000;
        stroke-dashoffset: 1000;
        animation: draw-check 1s ease-in-out forwards;
    }
    @keyframes draw-check {
        to {
            stroke-dashoffset: 0;
        }
    }
    .fade-in-up {
        animation: fade-in-up 0.6s ease-in-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    @keyframes fade-in-up {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="bg-gray-100 min-h-screen font-sans flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="relative w-full max-w-5xl bg-white rounded-3xl shadow-2xl border border-gray-200 p-6 sm:p-10 z-10 mx-auto overflow-hidden">
        
        <div class="relative z-10">

            @if(session('success') && isset($order))
                <!-- Success Header -->
                <div class="flex flex-col items-center text-center mb-8">
                    <div class="bg-green-100 p-4 rounded-full mb-5 ring-4 ring-green-50">
                        <div class="bg-green-200 p-3 rounded-full">
                            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path class="animate-check" stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2 fade-in-up" style="animation-delay: 0.2s;">Thank You for Your Order!</h1>
                    <p class="text-gray-600 text-base md:text-lg max-w-2xl fade-in-up" style="animation-delay: 0.4s;">{{ session('success') }}</p>
                    <p class="mt-4 text-lg font-bold text-gray-500 fade-in-up" style="animation-delay: 0.6s;">Order ID: <span class="text-green-600">#BLINGIT-{{ $order->id }}</span></p>
                </div>

                <!-- Grid Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                    
                    <!-- Left Column: Order Summary -->
                    <div class="lg:col-span-3 fade-in-up" style="animation-delay: 0.8s;">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                            Order Summary
                        </h2>
                        <div class="space-y-4">
                            @forelse($order->items as $item)
                            <div class="bg-gray-50 rounded-2xl p-4 shadow-sm border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $item->product->image_url ?? 'https://placehold.co/64x64' }}" class="w-16 h-16 rounded-xl border border-gray-200 object-cover" alt="{{$item->name}}" onerror="this.onerror=null;this.src='https://placehold.co/64x64/f0f0f0/999999?text=Img';">
                                        <div>
                                            <div class="font-semibold text-base text-gray-800">{{$item->name}}</div>
                                            <div class="text-sm text-gray-500">Qty: {{$item->quantity}}</div>
                                        </div>
                                    </div>
                                    <div class="text-green-700 text-lg font-bold">₹{{number_format($item->price * $item->quantity, 2)}}</div>
                                </div>
                            </div>
                            @empty
                                <p class="text-gray-500">Could not find items for this order.</p>
                            @endforelse
                        </div>
                        <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
                            <div class="flex justify-between items-center text-gray-600"><span>Subtotal</span><span class="font-semibold">₹{{number_format($order->subtotal, 2)}}</span></div>
                            <div class="flex justify-between items-center text-gray-600"><span>Discount</span><span class="font-semibold">- ₹{{number_format($order->discount, 2)}}</span></div>
                            <div class="flex justify-between items-center text-gray-600"><span>Delivery Fee</span><span class="font-semibold">₹{{number_format($order->delivery_fee, 2)}}</span></div>
                            <div class="flex justify-between items-center text-xl font-extrabold text-gray-900 mt-2">
                                <span>Total Paid</span>
                                <span class="text-green-600">₹{{number_format($order->total, 2)}}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Address, Payment -->
                    <div class="lg:col-span-2 space-y-8 fade-in-up" style="animation-delay: 1s;">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-2">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                Delivery Address
                            </h2>
                            <div class="bg-gray-50 rounded-2xl p-5 text-gray-700 text-base shadow-sm border border-gray-200 space-y-1">
                                <p class="font-semibold text-gray-800">{{ $order->name }}</p>
                                <p>{{ $order->address }}</p>
                                <p>{{ $order->city }}, {{ $order->state }} - {{ $order->zip }}</p>
                            </div>
                        </div>
                        <div>
                             <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                Contact Information
                            </h2>
                            <div class="bg-gray-50 rounded-2xl p-5 text-gray-700 text-base shadow-sm border border-gray-200">
                                <p>{{ $order->email }}</p>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                Payment Method
                            </h2>
                            <div class="bg-gray-50 rounded-2xl p-5 flex items-center gap-4 text-base font-semibold text-gray-800 shadow-sm border border-gray-200">
                               @if($order->payment_method == 'cod')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                <span>Cash on Delivery ({{ $order->payment_status }})</span>
                               @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                <span>Paid Online ({{ ucfirst($order->payment_method) }})</span>
                               @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-12 border-t border-gray-200 pt-8">
                    <a href="{{ route('home') }}" class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center py-3 px-6 text-base font-bold rounded-xl transition shadow-lg hover:shadow-green-500/30 hover:-translate-y-1 transform duration-300 ease-in-out flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        <span>Continue Shopping</span>
                    </a>
                    <a href="{{ route('orders') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-center py-3 px-6 text-base font-bold rounded-xl transition shadow-lg hover:shadow-gray-400/30 hover:-translate-y-1 transform duration-300 ease-in-out flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        <span>View My Orders</span>
                    </a>
                    <a href="{{ route('orders.invoice', $order) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-6 text-base font-bold rounded-xl transition shadow-lg hover:shadow-blue-500/30 hover:-translate-y-1 transform duration-300 ease-in-out flex items-center justify-center gap-2" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                        <span>Download Invoice</span>
                    </a>
                </div>

                <!-- Website Review Section -->
                <div class="my-10 border-t border-b border-gray-200 py-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">How was your experience?</h2>
                        <p class="text-gray-500 text-center mb-6">Your feedback helps us improve our service.</p>
                        
                        @if(!$reviewExists)
                        <form id="review-form" class="bg-gray-50 rounded-2xl p-6 space-y-4 shadow-sm border border-gray-200 max-w-2xl mx-auto review-card" novalidate>
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <div class="text-center">
                                <div class="star-rating inline-block">
                                    <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                                </div>
                                <p id="star-rating-error" class="text-red-600 text-xs text-center h-4 mt-2"></p>
                                <p id="rating-description" class="text-gray-600 text-sm mt-2 h-6 transition-all duration-300"></p>
                            </div>
                            
                            <div>
                                <textarea id="review-textarea" name="comment" rows="3" placeholder="Tell us more about your experience..." class="w-full rounded-lg border border-gray-300 p-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition"></textarea>
                                <p id="review-textarea-error" class="text-red-600 text-xs h-4 mt-1"></p>
                                <div class="flex justify-between text-xs text-gray-500 mt-1">
                                    <span>Minimum 10 characters required</span>
                                    <span id="char-count">0/500</span>
                                </div>
                            </div>
                            
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg font-semibold shadow-sm transition-transform hover:-translate-y-0.5 text-base">
                                <span id="submit-text">Submit Feedback</span>
                                <div id="submit-spinner" class="hidden"><i class="fas fa-spinner fa-spin"></i> Submitting...</div>
                            </button>
                        </form>
                        
                        <div id="review-success" class="hidden mt-6 bg-green-100 border border-green-200 rounded-2xl p-6 text-center max-w-2xl mx-auto text-green-800">
                            <div class="flex justify-center mb-4">
                                <i class="fas fa-check-circle text-4xl text-green-500"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Thank You!</h3>
                            <p>Your feedback has been submitted successfully.</p>
                        </div>
                        @else
                        <div class="mt-6 bg-green-100 border border-green-200 rounded-2xl p-6 text-center max-w-2xl mx-auto text-green-800">
                            <div class="flex justify-center mb-4">
                                <i class="fas fa-check-circle text-4xl text-green-500"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Feedback Submitted</h3>
                            <p>Thank you, you have already shared your feedback for this order.</p>
                        </div>
                        @endif
                    </div>
                </div>

            @else
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-800">No Order Information Found</h1>
                    <p class="text-gray-600 mt-2">It seems you've landed on this page by mistake. Let's get you back to shopping!</p>
                    <a href="{{ route('home') }}" class="mt-6 inline-block px-6 py-3 text-lg font-bold rounded-xl bling-btn">
                        Go to Homepage
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const reviewForm = document.getElementById('review-form');
    if (reviewForm) {
        let currentRating = 0;
        const ratingInputs = document.querySelectorAll('input[name="rating"]');
        const ratingDescription = document.getElementById('rating-description');
        const starError = document.getElementById('star-rating-error');
        const textarea = document.getElementById('review-textarea');
        const textareaError = document.getElementById('review-textarea-error');
        const charCount = document.getElementById('char-count');
        const submitText = document.getElementById('submit-text');
        const submitSpinner = document.getElementById('submit-spinner');
        const reviewSuccess = document.getElementById('review-success');

        const ratingDescriptions = {
            1: "Poor", 2: "Fair", 3: "Good", 4: "Very Good", 5: "Excellent!"
        };

        ratingInputs.forEach(input => {
            input.addEventListener('change', function() {
                currentRating = this.value;
                ratingDescription.textContent = ratingDescriptions[this.value];
                validateStars();
            });
        });

        textarea.addEventListener('input', function() {
            charCount.textContent = `${this.value.length}/500`;
            validateTextarea();
        });

        function validateStars() {
            const selected = document.querySelector('input[name="rating"]:checked');
            starError.textContent = selected ? '' : 'Please select a rating.';
            return !!selected;
        }

        function validateTextarea() {
            const val = textarea.value.trim();
            if (val.length < 10) {
                textareaError.textContent = 'Please provide at least 10 characters.';
                return false;
            }
            if (val.length > 500) {
                textareaError.textContent = 'Review cannot exceed 500 characters.';
                return false;
            }
            textareaError.textContent = '';
            return true;
        }

        reviewForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            if (validateStars() && validateTextarea()) {
                submitText.classList.add('hidden');
                submitSpinner.classList.remove('hidden');
                
                const formData = new FormData(reviewForm);
                const data = {
                    rating: currentRating,
                    comment: textarea.value.trim(),
                    order_id: formData.get('order_id'),
                    _token: formData.get('_token')
                };

                try {
                    const response = await fetch('{{ route("reviews.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': data._token,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify(data)
                    });
                    
                    const result = await response.json();

                    if(response.ok) {
                        reviewForm.style.display = 'none';
                        reviewSuccess.classList.remove('hidden');
                    } else {
                        alert(result.message || 'Could not submit your review. Please try again.');
                        submitText.classList.remove('hidden');
                        submitSpinner.classList.add('hidden');
                    }
                } catch(error) {
                    alert('An error occurred. Please check your connection and try again.');
                    submitText.classList.remove('hidden');
                    submitSpinner.classList.add('hidden');
                }
            }
        });
    }
});
</script>
@endpush

