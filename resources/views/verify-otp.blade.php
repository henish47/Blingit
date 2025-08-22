<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP | Blingit Grocery</title>

    <!-- Tailwind CSS v3 -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
  @vite('resources/css/app.css')
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Style for the disabled resend link */
        .disabled-link {
            color: #9ca3af; /* gray-400 */
            pointer-events: none;
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
                            One last step to secure your account.
                        </h2>
                        <p class="mt-4 text-gray-600 text-lg">
                            We've sent a One-Time Password (OTP) to your email address to ensure it's you.
                        </p>
                    </div>
                    <div class="mt-10 space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="bg-green-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800">Account Security</h3>
                                <p class="text-gray-600">Verifying your identity keeps your account safe.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="bg-green-100 p-3 rounded-full">
                               <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800">Seamless Communication</h3>
                                <p class="text-gray-600">Receive important account updates via email.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Verification Form -->
            <div class="p-8 sm:p-12 flex flex-col justify-center">
                <div class="w-full max-w-md mx-auto">
                    <div class="text-center lg:text-left mb-8">
                         <a href="/" class="lg:hidden flex items-center justify-center gap-2 group mb-6">
                            <span class="text-3xl font-extrabold text-gray-900">
                                bling<span class="text-green-600">it</span>
                            </span>
                        </a>
                        <h1 class="text-3xl font-extrabold text-gray-900">Verify Your OTP</h1>
                        <p class="text-gray-500 mt-2">
                            Please enter the 6-digit code we sent to your email.
                        </p>
                    </div>

                    <form id="otp-form" class="space-y-4" novalidate>
                        @csrf
                        <div>
                            <label for="otp-1" class="block text-sm font-medium text-gray-700 mb-2 text-center">Enter 6-Digit OTP</label>
                            <div class="flex gap-2 justify-center">
                                @for ($i = 1; $i <= 6; $i++)
                                    <input type="text"
                                           name="otp[]"
                                           maxlength="1"
                                           pattern="[0-9]*"
                                           inputmode="numeric"
                                           class="otp-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                                           required
                                           autocomplete="off"
                                           id="otp-{{ $i }}">
                                @endfor
                            </div>
                            <span id="otp-error" class="text-red-600 text-xs mt-2 text-center block h-4"></span>
                        </div>
                        
                        <div>
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-0.5 text-lg">
                                Verify & Proceed
                            </button>
                        </div>
                    </form>
                    
                    <div class="mt-6 text-center text-sm">
                        <p class="text-gray-600">Didn't receive the code? 
                            <a href="#" id="resend-otp-link" class="font-semibold text-green-600 hover:underline">Resend OTP</a>
                            <span id="resend-timer" class="text-gray-500"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const otpForm = document.getElementById('otp-form');
            const otpInputs = document.querySelectorAll('.otp-input');
            const otpError = document.getElementById('otp-error');
            const resendLink = document.getElementById('resend-otp-link');
            const resendTimerSpan = document.getElementById('resend-timer');
            let timer;

            // --- OTP Input Handling (Auto-focus and Backspace) ---
            otpInputs.forEach((input, index) => {
                input.addEventListener('input', (e) => {
                    // Only allow numbers
                    e.target.value = e.target.value.replace(/[^0-9]/g, '');
                    
                    if (input.value.length === 1 && index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                    validateOtp(); // Validate on each input
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });
            });

            // --- Form Submission ---
            otpForm.addEventListener('submit', function(e) {
                e.preventDefault();
                if (validateOtp()) {
                    let otpValue = Array.from(otpInputs).map(input => input.value).join('');
                    console.log('OTP Verified:', otpValue);
                    // On a real server, you would now verify this OTP.
                    // For this demo, we'll redirect.
                    window.location.href = '/reset-password';
                }
            });

            // --- Resend OTP Logic ---
            resendLink.addEventListener('click', function(e) {
                e.preventDefault();
                startResendTimer();
                // Add your logic here to actually resend the OTP via an API call
                console.log('Resending OTP...');
            });

            function startResendTimer() {
                let seconds = 30;
                resendLink.classList.add('disabled-link');
                
                timer = setInterval(() => {
                    resendTimerSpan.textContent = `(wait ${seconds}s)`;
                    seconds--;
                    if (seconds < 0) {
                        clearInterval(timer);
                        resendLink.classList.remove('disabled-link');
                        resendTimerSpan.textContent = '';
                    }
                }, 1000);
            }

            // --- Validation Functions ---
            function validateOtp() {
                const otpValue = Array.from(otpInputs).map(input => input.value).join('');
                if (otpValue.length !== 6) {
                    showError('Please enter the complete 6-digit OTP.');
                    return false;
                }
                if (!/^\d{6}$/.test(otpValue)) {
                    showError('OTP must contain only numbers.');
                    return false;
                }
                hideError();
                return true;
            }

            function showError(message) {
                otpError.textContent = message;
                otpInputs.forEach(input => {
                    input.classList.add('border-red-500');
                    input.classList.remove('border-gray-300');
                });
            }

            function hideError() {
                otpError.textContent = '';
                otpInputs.forEach(input => {
                    input.classList.remove('border-red-500');
                    input.classList.add('border-gray-300');
                });
            }
            
            // Start the timer on page load for the first time
            startResendTimer();
        });
    </script>
</body>
</html>
