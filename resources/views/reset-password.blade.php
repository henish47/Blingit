<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Blingit Grocery</title>

    <!-- Tailwind CSS v3 -->
    {{-- @vite('resources/css/app.css') --}}
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
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="relative w-full max-w-6xl bg-white rounded-3xl shadow-2xl border border-gray-200 overflow-hidden grid grid-cols-1 lg:grid-cols-2">
            
            <!-- Left Column: Information Panel -->
            <div class="hidden lg:block relative bg-green-50 p-10">
                <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('https://www.toptal.com/designers/subtlepatterns/uploads/leaves-3.png');"></div>
                <div class="relative z-10 flex flex-col justify-between h-full">
                    <div>
                        <a href="/" class="flex items-center gap-2 group mb-8">
                             <span class="text-3xl font-extrabold px-3 py-1 rounded-lg shadow-lg"
                                   style="font-family: 'Montserrat', 'Poppins', sans-serif; background-color: #FFFF00;">
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
                    <div class="text-center lg:text-left mb-8">
                         <a href="/" class="lg:hidden flex items-center justify-center gap-2 group mb-6">
                            <span class="text-3xl font-extrabold text-gray-900">
                                bling<span class="text-green-600">it</span>
                            </span>
                        </a>
                        <h1 class="text-3xl font-extrabold text-gray-900">Set Your New Password</h1>
                        <p class="text-gray-500 mt-1">Please create a new password for your account.</p>
                    </div>

                    <form id="resetPasswordForm" method="POST" action="{{ route('password.update') }}" class="space-y-5" novalidate>
                        @csrf
                        {{-- Hidden fields to pass the token and email --}}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <div class="relative">
                                 <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                     <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                 </span>
                                <input type="password" id="password" name="password" class="w-full pl-10 pr-4 py-3 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            </div>
                             @error('password')
                                 <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                            <div class="relative">
                               <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                     <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                 </span>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            </div>
                        </div>
                        
                        <div class="pt-2">
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 text-lg">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('resetPasswordForm');
    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput = document.getElementById('password_confirmation');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        clearAllErrors();
        let isValid = true;

        // --- Validation Rules ---

        // 1. Password Validation
        const passwordValue = passwordInput.value;
        if (passwordValue.trim() === '') {
            showError(passwordInput, 'The new password field is required.');
            isValid = false;
        } else if (passwordValue.length < 8) {
            showError(passwordInput, 'The password must be at least 8 characters long.');
            isValid = false;
        }

        // 2. Password Confirmation Validation
        const passwordConfirmationValue = passwordConfirmationInput.value;
        if (passwordConfirmationValue.trim() === '') {
            showError(passwordConfirmationInput, 'The password confirmation field is required.');
            isValid = false;
        } else if (passwordValue !== passwordConfirmationValue) {
            showError(passwordConfirmationInput, 'The password confirmation does not match.');
            isValid = false;
        }

        if (isValid) {
            form.submit();
        }
    });

    function showError(input, message) {
        input.classList.add('border-red-500');
        input.classList.remove('border-gray-300');
        
        const errorElement = document.createElement('span');
        errorElement.className = 'text-red-600 text-xs mt-1 js-error';
        errorElement.textContent = message;
        
        // Insert after the input's parent container div
        input.parentElement.parentElement.appendChild(errorElement);
    }

    function clearAllErrors() {
        const errorMessages = form.querySelectorAll('.js-error');
        errorMessages.forEach(error => error.remove());

        const inputsWithErrors = form.querySelectorAll('.border-red-500');
        inputsWithErrors.forEach(input => {
            input.classList.remove('border-red-500');
            input.classList.add('border-gray-300');
        });
    }
});
</script>
</body>
</html>
