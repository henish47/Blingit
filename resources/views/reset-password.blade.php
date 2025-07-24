<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Blingit Grocery</title>

    <!-- Tailwind CSS v3 -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
  @vite('resources/css/app.css')
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
                            Create a New Password
                        </h2>
                        <p class="mt-4 text-gray-600 text-lg">
                            Your security is important. Choose a strong, new password to protect your account.
                        </p>
                    </div>
                    <div class="mt-10 space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="bg-green-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800">Strong & Secure</h3>
                                <p class="text-gray-600">Use a mix of letters, numbers, and symbols.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="bg-green-100 p-3 rounded-full">
                               <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800">Easy to Remember</h3>
                                <p class="text-gray-600">Choose something memorable for you.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Form -->
            <div class="p-8 sm:p-12 flex flex-col justify-center">
                <div class="w-full max-w-md mx-auto">
                    <div id="reset-form-container">
                        <div class="text-center lg:text-left mb-8">
                             <a href="/" class="lg:hidden flex items-center justify-center gap-2 group mb-6">
                                <span class="text-3xl font-extrabold text-gray-900">
                                    bling<span class="text-green-600">it</span>
                                </span>
                            </a>
                            <h1 class="text-3xl font-extrabold text-gray-900">Set Your New Password</h1>
                            <p class="text-gray-500 mt-1">Please create a new password for your account.</p>
                        </div>

                        <form id="reset-password-form" method="POST" action="#" class="space-y-5" novalidate>
                            <input type="hidden" name="token" value="static_token_placeholder">

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                                    </span>
                                    <input type="email" id="email" name="email" value="user@example.com" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm bg-gray-100 cursor-not-allowed" required readonly />
                                </div>
                            </div>
                            
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                <div class="relative">
                                     <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    </span>
                                    <input type="password" id="password" name="password" class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" placeholder="••••••••" required />
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePasswordVisibility('password')">
                                        <svg id="eye-icon-password" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </span>
                                </div>
                                <span id="password-error" class="text-red-600 text-xs mt-1 h-4 block"></span>
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                <div class="relative">
                                     <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    </span>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" placeholder="••••••••" required />
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePasswordVisibility('password_confirmation')">
                                        <svg id="eye-icon-password_confirmation" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </span>
                                </div>
                                <span id="confirm-password-error" class="text-red-600 text-xs mt-1 h-4 block"></span>
                            </div>
                            
                            <div class="pt-2">
                                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-0.5 text-lg">
                                    Reset Password
                                </button>
                            </div>
                        </form>
                    </div>

                    <div id="success-view" class="hidden text-center">
                        <div class="bg-green-100 p-4 rounded-full mb-5 ring-4 ring-green-50 w-24 h-24 mx-auto flex items-center justify-center">
                            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h1 class="text-3xl font-extrabold text-gray-900">Password Reset!</h1>
                        <p class="text-gray-500 mt-2">Your password has been changed successfully.</p>
                        <p class="text-gray-500 mt-4">Redirecting to login in <span id="countdown">3</span> seconds...</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        const eyeIconSvg = {
            open: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`,
            closed: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 .946-3.11 3.586-5.447 6.834-6.25M17.953 5.447A9.96 9.96 0 0121.542 12c-1.274 4.057-5.064 7-9.542 7a9.96 9.96 0 01-2.553-.447m-4.498-4.498L3 8.5m18 0l-2.047-2.047M12 12a3 3 0 11-6 0 3 3 0 016 0z" />`
        };

        function togglePasswordVisibility(fieldId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById(`eye-icon-${fieldId}`);
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = eyeIconSvg.closed;
            } else {
                input.type = 'password';
                icon.innerHTML = eyeIconSvg.open;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const resetFormContainer = document.getElementById('reset-form-container');
            const successView = document.getElementById('success-view');
            const resetForm = document.getElementById('reset-password-form');
            const countdownElement = document.getElementById('countdown');
            
            const passwordInput = document.getElementById('password');
            const passwordConfirmationInput = document.getElementById('password_confirmation');
            const passwordError = document.getElementById('password-error');
            const confirmPasswordError = document.getElementById('confirm-password-error');

            resetForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const isPasswordValid = validatePassword();
                const isConfirmPasswordValid = validateConfirmPassword();

                if (isPasswordValid && isConfirmPasswordValid) {
                    console.log('Password reset successfully.');
                    resetFormContainer.classList.add('hidden');
                    successView.classList.remove('hidden');

                    let seconds = 3;
                    countdownElement.textContent = seconds;

                    const countdownInterval = setInterval(() => {
                        seconds--;
                        countdownElement.textContent = seconds;
                        if (seconds <= 0) {
                            clearInterval(countdownInterval);
                            window.location.href = '/login';
                        }
                    }, 1000);
                }
            });

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
                }
                hideError(passwordInput, passwordError);
                validateConfirmPassword(); // Re-check confirmation if password changes
                return true;
            }

            function validateConfirmPassword() {
                const password = passwordInput.value;
                const confirmPassword = passwordConfirmationInput.value;
                if (confirmPassword === '') {
                    showError(passwordConfirmationInput, confirmPasswordError, 'Please confirm your new password.');
                    return false;
                }
                if (password !== confirmPassword) {
                    showError(passwordConfirmationInput, confirmPasswordError, 'Passwords do not match.');
                    return false;
                }
                hideError(passwordConfirmationInput, confirmPasswordError);
                return true;
            }

            function showError(inputEl, errorEl, message) {
                inputEl.classList.add('border-red-500');
                inputEl.classList.remove('border-gray-300');
                errorEl.textContent = message;
            }

            function hideError(inputEl, errorEl) {
                inputEl.classList.remove('border-red-500');
                inputEl.classList.add('border-gray-300');
                errorEl.textContent = '';
            }

            // Real-time validation
            passwordInput.addEventListener('input', validatePassword);
            passwordConfirmationInput.addEventListener('input', validateConfirmPassword);
        });
    </script>
</body>
</html>
