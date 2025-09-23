@extends('layout')

@section('title', 'Edit Profile | Blingit Grocery')

@section('content')

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    .profile-card { transition: all 0.3s ease; background-color: #fff; }
    .profile-input { transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out; background-color: #fff; }
    .profile-input.border-red-500 { border-color: #ef4444; } /* Ensure error border color is applied */
    .profile-input:hover { border-color: #22c55e; box-shadow: 0 0 8px rgba(34, 197, 94, 0.2); }
    .image-upload-container { position: relative; cursor: pointer; width: 128px; height: 128px; margin: 0 auto; transition: transform 0.3s ease; }
    .image-upload-container:hover { transform: scale(1.05); }
    .image-upload-container img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 4px solid #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    .upload-icon { position: absolute; bottom: 5px; right: 5px; background-color: #22c55e; color: white; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border: 2px solid white; font-size: 1.1rem; cursor: pointer; transition: background-color 0.3s ease, transform 0.2s ease; }
    .upload-icon:hover { background-color: #16a34a; transform: scale(1.1); }
    .btn-custom:hover { opacity: 0.9; }
    .profile-input:focus { outline: none; border-color: #22c55e; box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2); }
    .section-header { display: flex; align-items: center; gap: 0.75rem; }
</style>

<div class="bg-gray-50 min-h-screen py-10">
    <div class="container mx-auto px-4">
        <div class="text-center md:text-left mb-8">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-2">Edit Your Profile</h1>
            <p class="text-gray-500">Keep your personal information up to date.</p>
        </div>

        <!-- Session Messages -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
                <p class="font-bold">Please fix the following errors:</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-2xl shadow-lg text-center profile-card">
                    <form id="profile-pic-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="image-upload-container mx-auto mb-4" onclick="document.getElementById('profile-pic-upload').click()">
                            <img id="profile-pic-preview" src="{{ $user->profile_photo_url }}" alt="Profile Picture">
                            <div class="upload-icon">
                                <i class="fas fa-camera"></i>
                            </div>
                            <input type="file" name="profile_photo" id="profile-pic-upload" class="hidden" accept="image/*" onchange="previewImage(event)">
                        </div>
                    </form>
                    <h2 class="text-2xl font-bold text-gray-800 mt-2">{{ $user->name }}</h2>
                    <p class="text-gray-500 mb-2">{{ $user->email }}</p>
                    <p class="text-sm text-gray-400">Joined on: {{ $user->created_at->format('F j, Y') }}</p>
                </div>
            </div>

            <div class="lg:col-span-2">
                <form id="profile-update-form" action="{{ route('profile.update') }}" method="POST" class="space-y-8 bg-white p-8 rounded-2xl shadow-lg" novalidate>
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <div class="section-header mb-6 border-b pb-4">
                            <i class="fas fa-user-circle text-green-600 text-xl"></i>
                            <h3 class="text-xl font-bold text-gray-800">Personal Information</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg profile-input" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg profile-input" required>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="section-header mb-6 border-b pb-4">
                            <i class="fas fa-lock text-green-600 text-xl"></i>
                            <h3 class="text-xl font-bold text-gray-800">Change Password</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg profile-input" placeholder="Enter new password">
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg profile-input" placeholder="Confirm new password">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 mt-6">
                        <a href="{{ route('dashboard') }}" class="px-8 py-3 text-sm font-semibold rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 transition btn-custom">
                            Cancel
                        </a>
                        <button type="submit" class="px-8 py-3 text-sm font-semibold rounded-lg border-2 border-green-600 text-white bg-green-600 hover:bg-green-700 transition shadow-md btn-custom">
                            <i class="fas fa-save mr-2"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Handles previewing the new profile picture and submitting the form
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('profile-pic-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        // Automatically submit the form when a new image is selected
        document.getElementById('profile-pic-form').submit();
    }

    // Handles client-side validation for the main profile form
    document.addEventListener('DOMContentLoaded', function () {
        const profileForm = document.getElementById('profile-update-form');
        if (!profileForm) return;

        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const passwordConfirmationInput = document.getElementById('password_confirmation');

        profileForm.addEventListener('submit', function (event) {
            event.preventDefault();
            clearAllErrors();
            let isFormValid = true;

            // --- Validation Rules ---

            // 1. Name validation: required, no numbers or special characters
            const nameValue = nameInput.value.trim();
            if (nameValue === '') {
                showError(nameInput, 'The name field is required.');
                isFormValid = false;
            } else if (!/^[a-zA-Z\s.'-]+$/.test(nameValue)) {
                showError(nameInput, 'The name may only contain letters and spaces.');
                isFormValid = false;
            }

            // 2. Email validation: required, must be a valid email format
            const emailValue = emailInput.value.trim();
            if (emailValue === '') {
                showError(emailInput, 'The email field is required.');
                isFormValid = false;
            } else if (!isValidEmail(emailValue)) {
                showError(emailInput, 'Please enter a valid email address.');
                isFormValid = false;
            }

            // 3. Password validation: only if user intends to change it
            const passwordValue = passwordInput.value;
            const passwordConfirmationValue = passwordConfirmationInput.value;

            if (passwordValue !== '' || passwordConfirmationValue !== '') {
                if (passwordValue.length < 8) {
                    showError(passwordInput, 'The new password must be at least 8 characters long.');
                    isFormValid = false;
                }
                if (passwordValue !== passwordConfirmationValue) {
                    showError(passwordConfirmationInput, 'The password confirmation does not match.');
                    isFormValid = false;
                }
            }

            if (isFormValid) {
                profileForm.submit();
            }
        });

        function showError(input, message) {
            input.classList.add('border-red-500');
            input.classList.remove('border-gray-300');
            const errorElement = document.createElement('p');
            errorElement.className = 'text-red-600 text-sm mt-1 js-error';
            errorElement.textContent = message;
            // Insert error message in the parent div after the input
            input.parentNode.appendChild(errorElement);
        }

        function clearAllErrors() {
            const errorMessages = profileForm.querySelectorAll('.js-error');
            errorMessages.forEach(error => error.remove());
            const inputsWithErrors = profileForm.querySelectorAll('.border-red-500');
            inputsWithErrors.forEach(input => {
                input.classList.remove('border-red-500');
                input.classList.add('border-gray-300');
            });
        }

        function isValidEmail(email) {
            const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return regex.test(email);
        }
    });
</script>
@endpush

