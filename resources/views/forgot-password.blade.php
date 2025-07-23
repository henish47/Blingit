<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Blingit Grocery</title>

    <!-- Tailwind CSS v3 -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        /* Apply Poppins font to the entire application */
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    {{-- 
      This Blade template provides a modern, responsive "Forgot Password" page using an OTP flow.
      - It's styled entirely with Tailwind CSS.
      - Features a two-column layout consistent with the login/register pages.
      - The form prompts the user for their phone number and redirects to the OTP verification page on submit.
      - Includes a "Back to Login" link for easy navigation.
      - All icons are inline SVGs for optimal performance.
    --}}
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="relative w-full max-w-6xl bg-white rounded-3xl shadow-2xl border border-gray-200 overflow-hidden grid grid-cols-1 lg:grid-cols-2">
            
            <!-- Left Column: Information Panel -->
            <div class="hidden lg:block relative bg-green-50 p-10">
                <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('https://www.toptal.com/designers/subtlepatterns/uploads/leaves-3.png');"></div>
                <div class="relative z-10 flex flex-col justify-between h-full">
                    <div>
                        <a href="/" class="flex items-center gap-2 group mb-8">
                            <span class="text-3xl font-extrabold text-gray-900">
                                bling<span class="text-green-600">it</span>
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
                        <p class="text-gray-500 mt-1">Enter your phone number to receive an OTP.</p>
                    </div>

                    <form id="send-otp-form" class="space-y-6">
                        @csrf
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Gmail</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 0a4 4 0 10-8 0 4 4 0 008 0zm2 4v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2"></path></svg>
                                </span>
                                <input type="email" id="email" name="email" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" placeholder="Enter your registered Gmail address" required />
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Please enter the Gmail address you used to register your account. We will send an OTP to this email for password reset.</p>
                        </div>
                        
                        <div>
                           <a href="/otp-verify" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-0.5 text-lg text-center block">
                             Send OTP
                            </a>

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
            const sendOtpForm = document.getElementById('send-otp-form');

            sendOtpForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent default form submission
                
                const phoneInput = document.getElementById('phone');
                if (phoneInput.value.trim().length > 5) { // Simple validation
                    console.log('Redirecting to OTP verification for', phoneInput.value);
                    // Redirect to the OTP verification page
                    window.location.href = '/otp-verify';
                } else {
                    alert('Please enter a valid phone number.');
                }
            });
        });
    </script>
</body>
</html>
