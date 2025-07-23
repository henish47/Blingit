@extends('layout')

@section('title', 'Register | Blingit Grocery')

@push('scripts')
{{-- Pushing scripts to the layout stack --}}
<script type="module" src="https://cdn.skypack.dev/motion"></script>
<script src="{{ asset('js/register.js') }}"></script>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <div class="relative w-full max-w-6xl bg-white rounded-3xl shadow-2xl border border-gray-200 overflow-hidden grid grid-cols-1 lg:grid-cols-2">
        
        <!-- Left Column: Information Panel -->
        <div class="hidden lg:block relative bg-green-50 p-10" id="info-panel">
            <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('https://www.toptal.com/designers/subtlepatterns/uploads/leaves-3.png');"></div>
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div>
                    <a href="/" class="flex items-center gap-2 group mb-8">
                        <span class="text-3xl font-extrabold text-gray-900">
                            bling<span class="text-green-600">it</span>
                        </span>
                    </a>
                    <h2 class="text-4xl font-extrabold text-gray-800 leading-tight">
                        Join the fastest grocery delivery <span class="text-green-600">in town.</span>
                    </h2>
                    <p class="mt-4 text-gray-600 text-lg">
                        Create an account to enjoy exclusive deals, faster checkouts, and a personalized shopping experience.
                    </p>
                </div>
                <div class="mt-10 space-y-6">
                    <div class="flex items-start gap-4 info-item">
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">10-Minute Delivery</h3>
                            <p class="text-gray-600">Why wait? Get your order in minutes.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 info-item">
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Freshness Guaranteed</h3>
                            <p class="text-gray-600">We pick only the best for you.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Registration Form -->
        <div class="p-8 sm:p-12 flex flex-col justify-center">
            <div class="w-full max-w-md mx-auto">
                <div class="text-center lg:text-left mb-8" id="form-header">
                     <a href="/" class="lg:hidden flex items-center justify-center gap-2 group mb-6">
                        <span class="text-3xl font-extrabold text-gray-900">
                            bling<span class="text-green-600">it</span>
                        </span>
                    </a>
                    <h1 class="text-3xl font-extrabold text-gray-900">Create an Account</h1>
                    <p class="text-gray-500 mt-1">Let's get you started with fresh groceries.</p>
                </div>

                <form id="register-form" method="POST" action="/register" class="space-y-5" novalidate>
                    @csrf
                    <div>
                        <label for="register-name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </span>
                            <input type="text" id="register-name" name="name" value="{{ old('name') }}" class="w-full pl-10 pr-4 py-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('name') border-red-500 @else border-gray-300 @enderror" placeholder="John Doe" required />
                        </div>
                        <span id="name-error" class="text-red-600 text-xs mt-1"></span>
                        @error('name')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="register-email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                            </span>
                            <input type="email" id="register-email" name="email" value="{{ old('email') }}" class="w-full pl-10 pr-4 py-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('email') border-red-500 @else border-gray-300 @enderror" placeholder="you@example.com" required />
                        </div>
                        <span id="email-error" class="text-red-600 text-xs mt-1"></span>
                        @error('email')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="register-password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                             <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </span>
                            <input type="password" id="register-password" name="password" class="w-full pl-10 pr-4 py-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('password') border-red-500 @else border-gray-300 @enderror" placeholder="••••••••" required />
                        </div>
                        <span id="password-error" class="text-red-600 text-xs mt-1"></span>
                        @error('password')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                     <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <div class="relative">
                             <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full pl-10 pr-4 py-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('password_confirmation') border-red-500 @else border-gray-300 @enderror" placeholder="••••••••" required />
                        </div>
                        <span id="confirm-password-error" class="text-red-600 text-xs mt-1"></span>
                        @error('password_confirmation')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-0.5 text-lg">
                            Create Account
                        </button>
                    </div>
                </form>

             
                <div class="mt-8 text-center">
                    <span class="text-gray-600">Already have an account?</span>
                    <a href="/login" class="text-green-600 font-bold hover:underline ml-1">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @push('scripts')
<script type="module">
    import { animate } from "https://cdn.skypack.dev/motion";

    document.addEventListener('DOMContentLoaded', function () {
        // --- Page Load Animations ---
        const sequence = [
            ["#info-panel", { opacity: [0, 1], x: [-20, 0] }, { duration: 0.6, easing: "ease-out" }],
            [".info-item", { opacity: [0, 1], x: [-10, 0] }, { duration: 0.5, delay: animate.stagger(0.1), at: 0.3 }],
            ["#form-header", { opacity: [0, 1], y: [10, 0] }, { duration: 0.5, at: 0.2 }],
            ["#register-form > div", { opacity: [0, 1], y: [10, 0] }, { duration: 0.5, delay: animate.stagger(0.1), at: 0.4 }],
        ];
        animate(sequence);


        // --- Form Validation Logic ---
        const form = document.getElementById('register-form');
        const nameInput = document.getElementById('register-name');
        const emailInput = document.getElementById('register-email');
        const passwordInput = document.getElementById('register-password');
        const confirmPasswordInput = document.getElementById('password_confirmation');

        const nameError = document.getElementById('name-error');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');
        const confirmPasswordError = document.getElementById('confirm-password-error');

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            
            const isNameValid = validateName();
            const isEmailValid = validateEmail();
            const isPasswordValid = validatePassword();
            const isConfirmPasswordValid = validateConfirmPassword();

            if (isNameValid && isEmailValid && isPasswordValid && isConfirmPasswordValid) {
                form.submit();
            }
        });

        function validateName() {
            const name = nameInput.value.trim();
            const nameRegex = /^[a-zA-Z\s.'-]+$/; // Allows letters, spaces, and some special characters in names
            if (name === '') {
                showError(nameInput, nameError, 'Full name is required.');
                return false;
            } else if (!nameRegex.test(name)) {
                showError(nameInput, nameError, 'Please enter a valid name (letters and spaces only).');
                return false;
            } else {
                hideError(nameInput, nameError);
                return true;
            }
        }

        function validateEmail() {
            const email = emailInput.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === '') {
                showError(emailInput, emailError, 'Email address is required.');
                return false;
            } else if (!emailRegex.test(email)) {
                showError(emailInput, emailError, 'Please enter a valid email address.');
                return false;
            } else {
                hideError(emailInput, emailError);
                return true;
            }
        }

        function validatePassword() {
            const password = passwordInput.value;
            const errors = [];
            if (password.length < 8) errors.push('be at least 8 characters');
            if (!/[A-Z]/.test(password)) errors.push('contain an uppercase letter');
            if (!/[a-z]/.test(password)) errors.push('contain a lowercase letter');
            if (!/\d/.test(password)) errors.push('contain a number');
            if (!/[@$!%*?&]/.test(password)) errors.push('contain a special character');

            if (errors.length > 0) {
                showError(passwordInput, passwordError, 'Password must ' + errors.join(', ') + '.');
                return false;
            } else {
                hideError(passwordInput, passwordError);
                // Also re-validate the confirm password field if the main password changes
                validateConfirmPassword(); 
                return true;
            }
        }

        function validateConfirmPassword() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            if (confirmPassword === '') {
                showError(confirmPasswordInput, confirmPasswordError, 'Please confirm your password.');
                return false;
            } else if (password !== confirmPassword) {
                showError(confirmPasswordInput, confirmPasswordError, 'Passwords do not match.');
                return false;
            } else {
                hideError(confirmPasswordInput, confirmPasswordError);
                return true;
            }
        }

        function showError(input, errorEl, message) {
            input.classList.add('border-red-500');
            input.classList.remove('border-gray-300');
            errorEl.textContent = message;
        }

        function hideError(input, errorEl) {
            input.classList.remove('border-red-500');
            input.classList.add('border-gray-300');
            errorEl.textContent = '';
        }

        // Add real-time validation
        nameInput.addEventListener('input', validateName);
        emailInput.addEventListener('input', validateEmail);
        passwordInput.addEventListener('input', validatePassword);
        confirmPasswordInput.addEventListener('input', validateConfirmPassword);
    });
</script>
@endpush --}}
