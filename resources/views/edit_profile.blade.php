@extends('layout')

@section('title', 'Edit Profile | Blingit Grocery')

@section('content')

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    /* Custom styles for better form presentation with hover effects */
    .profile-card {
        transition: all 0.3s ease;
        background-color: #fff;
    }

    .profile-input {
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        background-color: #fff;
    }

    /* Hover effect for input fields */
    .profile-input:hover {
        border-color: #22c55e;
        box-shadow: 0 0 8px rgba(34, 197, 94, 0.2);
    }

    /* Profile picture container styles */
    .image-upload-container {
        position: relative;
        cursor: pointer;
        width: 128px;
        height: 128px;
        margin: 0 auto;
        transition: transform 0.3s ease;
    }

    .image-upload-container:hover {
        transform: scale(1.05);
    }

    .image-upload-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: box-shadow 0.3s ease;
    }

    .upload-icon {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: #22c55e;
        color: white;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .upload-icon:hover {
        background-color: #16a34a;
        transform: scale(1.1);
    }

    /* Button hover states for consistency and feedback */
    .btn-custom:hover {
        opacity: 0.9;
    }

    /* Enhance form inputs for focus */
    .profile-input:focus {
        outline: none;
        border-color: #22c55e;
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
    }

    /* Additional spacing for better layout */
    .section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
</style>

<div class="bg-gray-50 min-h-screen py-10">
    <div class="container mx-auto px-4">
        <!-- Page Header -->
        <div class="text-center md:text-left mb-8">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-2">Edit Your Profile</h1>
            <p class="text-gray-500">Keep your personal information up to date.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Column: Profile Picture -->
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-2xl shadow-lg text-center profile-card">
                    <div class="image-upload-container mx-auto mb-4" aria-label="Change Profile Picture" role="button" tabindex="0" onclick="triggerFileInput()">
                        <img id="profile-pic-preview" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIwMIGTutu1jpkhgNCLM-Rd2gz3d0MRSXuPw&s" alt="Profile Picture" aria-hidden="true">
                        <label for="profile-pic-upload" class="upload-icon" aria-label="Upload Profile Picture">
                            <i class="fas fa-camera"></i>
                        </label>
                        <input type="file" id="profile-pic-upload" class="hidden" accept="image/*" onchange="previewImage(this)">
                    </div>
                    <h2 id="profile-name" class="text-2xl font-bold text-gray-800 mt-2">Henish Savaliya</h2>
                    <p id="profile-email" class="text-gray-500 mb-2">henishpatel47@gmail.com</p>
                    <p class="text-sm text-gray-400">Joined on: July 24, 2025</p>
                </div>
            </div>

<!-- Right Column: Profile Form -->
<div class="lg:col-span-2">
    <form action="#" method="POST" class="space-y-8 bg-white p-8 rounded-2xl shadow-lg">
        @csrf
        
        <!-- Personal Information Section -->
        <div>
            <div class="section-header mb-6 border-b pb-4 flex items-center space-x-2">
                <i class="fas fa-user-circle text-green-600 text-xl"></i>
                <h3 class="text-xl font-bold text-gray-800">Personal Information</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Full Name -->
                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="full_name" name="full_name" value=""
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg profile-input focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent"
                        placeholder="Enter your full name" aria-label="Full Name">
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email_address" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email_address" name="email_address" value=""
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg profile-input bg-gray-100 "
                        placeholder="your.email@example.com"  aria-disabled="true" aria-label="Email Address">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg profile-input focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent"
                        placeholder="Enter new password" aria-label="New Password">
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4 mt-6">
            <button type="button"
                class="px-8 py-3 text-sm font-semibold rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 transition duration-300 ease-in-out btn-custom">
                Cancel
            </button>
            <button type="submit"
                class="px-8 py-3 text-sm font-semibold rounded-lg border-2 border-green-600 text-white bg-green-600 hover:bg-green-700 hover:border-green-700 transition duration-300 ease-in-out shadow-md flex items-center btn-custom">
                <i class="fas fa-save mr-2"></i>
                Save Changes
            </button>
        </div>
    </form>
</div>


        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const nameInput = document.getElementById('full_name');
    const emailInput = document.getElementById('email_address');
    const passwordInput = document.getElementById('password');

    // Create error message containers
    const nameError = createErrorElement(nameInput);
    const emailError = createErrorElement(emailInput);
    const passwordError = createErrorElement(passwordInput);

    function createErrorElement(input) {
        const error = document.createElement('p');
        error.className = 'text-red-600 text-sm mt-1';
        input.parentNode.appendChild(error);
        return error;
    }

    form.addEventListener('submit', function (e) {
        let valid = true;

   // Full Name Validation (no numbers, minimum 3 letters)
const nameValue = nameInput.value.trim();
const nameRegex = /^[A-Za-z\s]{3,}$/;

if (!nameRegex.test(nameValue)) {
    nameError.textContent = 'Name must be at least 3 letters and contain no numbers.';
    valid = false;
} else {
    nameError.textContent = '';
}


        // Email Validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value.trim())) {
            emailError.textContent = 'Please enter a valid email address.';
            valid = false;
        } else {
            emailError.textContent = '';
        }

        // Password Validation
        const password = passwordInput.value;
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
        if (!passwordPattern.test(password)) {
            passwordError.textContent = 'Password must be at least 8 characters, include uppercase, lowercase, number, and special character.';
            valid = false;
        } else {
            passwordError.textContent = '';
        }

        if (!valid) {
            e.preventDefault();
        }
    });
});
</script>

<style>
input:invalid {
    border-color: red;
}
</style>

@endsection
