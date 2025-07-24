<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Blingit Grocery</title>
  @vite('resources/css/app.css')
    <!-- Tailwind CSS v3 -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script src="{{ asset('js/forgot_password.js') }}"></script>
   
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>

    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="relative w-full max-w-6xl bg-white rounded-3xl shadow-2xl border border-gray-200 overflow-hidden grid grid-cols-1 lg:grid-cols-2">
            
            <!-- Left Column: Information Panel -->
            <div class="hidden lg:block relative bg-green-50 p-10">
                <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('https://www.toptal.com/designers/subtlepatterns/uploads/leaves-3.png');"></div>
                <div class="relative z-10 flex flex-col justify-between h-full">
                    <div>
                        <a href="/" class="flex items-center gap-2 group mb-8">
                             <span class="text-3xl font-extrabold px-3 py-1 rounded-lg shadow-lg blingit-logo-text"
                        style="background-color: #FFFF00;">
                        <span class="text-black">bling</span><span class="text-green-600">it</span>
                    </span>
                        </a>
                        <h2 class="text-4xl font-extrabold text-gray-800 leading-tight">
                            Forgot Your Password?
                        </h2>
                        <p class="mt-4 text-gray-600 text-lg">
                            No worries! Just enter your Gmail address below, and we'll send you an OTP to reset your password.
                        </p>
                    </div>
                    <div class="mt-10 space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="bg-green-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800">Secure Process</h3>
                                <p class="text-gray-600">Your account security is our top priority.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="bg-green-100 p-3 rounded-full">
                               <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800">Quick & Easy</h3>
                                <p class="text-gray-600">Get back to shopping in just a few clicks.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Form -->
            <div class="p-8 sm:p-12 flex flex-col justify-center">
                <div class="w-full max-w-md mx-auto">
                    <div class="text-center lg:text-left mb-8">
                         <a href="/" class="lg:hidden flex items-center justify-center gap-2 group mb-6">
                            <span class="text-3xl font-extrabold text-gray-900">
                                bling<span class="text-green-600">it</span>
                            </span>
                        </a>
                        <h1 class="text-3xl font-extrabold text-gray-900">Reset Password</h1>
                        <p class="text-gray-500 mt-1">Enter your registered Gmail to receive an OTP.</p>
                    </div>

                    <form id="send-otp-form" class="space-y-6" novalidate>
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Gmail Address</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                                </span>
                                <input type="email" id="email" name="email" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" placeholder="you@gmail.com" required />
                            </div>
                            <span id="email-error" class="text-red-600 text-xs mt-1 h-4 block"></span>
                        </div>
                        
                        <div>
                           <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-0.5 text-lg text-center block">
                                Send OTP
                           </button>
                        </div>
                    </form>

                    <div class="mt-8 text-center">
                        <a href="/login" class="text-green-600 font-bold hover:underline ml-1 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                            Back to Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('send-otp-form');
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('email-error');

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent default form submission
                
                if (validateEmail()) {
                    console.log('Validation successful. Redirecting for email:', emailInput.value);
                    // On a real server, you would now make an API call to send the OTP.
                    // For this demo, we'll redirect as originally intended.
                    window.location.href = '/otp-verify';
                } else {
                    console.log('Validation failed.');
                }
            });

            function validateEmail() {
                const email = emailInput.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const gmailRegex = /@gmail\.com$/;

                if (email === '') {
                    showError('Gmail address is required.');
                    return false;
                } else if (!emailRegex.test(email)) {
                    showError('Please enter a valid email address.');
                    return false;
                } else if (!gmailRegex.test(email)) {
                    showError('Please enter a valid @gmail.com address.');
                    return false;
                } else {
                    hideError();
                    return true;
                }
            }

            function showError(message) {
                emailInput.classList.add('border-red-500');
                emailInput.classList.remove('border-gray-300');
                emailError.textContent = message;
            }

            function hideError() {
                emailInput.classList.remove('border-red-500');
                emailInput.classList.add('border-gray-300');
                emailError.textContent = '';
            }

            // Add real-time validation as the user types
            emailInput.addEventListener('input', validateEmail);
        });
    </script>
       {{-- <script src="{{ asset('js/forgot_password.js') }}"></script> --}}
</body>
</html>
