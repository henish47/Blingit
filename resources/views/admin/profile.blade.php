@extends('admin.layout')

@section('title', 'Profile')

@section('content')

    <div>
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800">My Profile</h1>
            <p class="text-gray-500 mt-1">Manage your profile details and update your password.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Profile Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 text-center">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=10b981&color=fff&size=128&rounded=true"
                        alt="Admin Avatar" class="w-32 h-32 rounded-full mx-auto mb-4 border-4 border-green-100 shadow-md">
                    <h2 class="text-2xl font-bold text-gray-800">Admin</h2>
                    <p class="text-gray-500">Super Admin</p>
                    <button
                        class="mt-4 w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2 rounded-lg transition text-sm">
                        Change Profile Picture
                    </button>
                </div>
            </div>

            <!-- Right Column: Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <form id="profileForm">
                        <!-- Profile Information -->
                        <div class="border-b border-gray-200 pb-6 mb-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Profile Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full
                                        Name</label>
                                    <input type="text" id="full_name"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-500">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                        Address</label>
                                    <input type="email" id="email"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-500">
                                </div>
                            </div>
                        </div>

                        <!-- Change Password -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Change Password</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="current_password"
                                        class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                    <input type="password" id="current_password"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                        placeholder="Enter your current password">
                                </div>
                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">New
                                        Password</label>
                                    <input type="password" id="new_password"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                        placeholder="Enter a new password">
                                </div>
                                <div>
                                    <label for="confirm_password"
                                        class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                    <input type="password" id="confirm_password"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                        placeholder="Confirm your new password">
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 text-right">
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ✅ JavaScript Strong Validation -->
    <script>
        document.getElementById("profileForm").addEventListener("submit", function (event) {
            const fullName = document.getElementById("full_name");
            const email = document.getElementById("email");
            const currentPassword = document.getElementById("current_password");
            const newPassword = document.getElementById("new_password");
            const confirmPassword = document.getElementById("confirm_password");

            // Clear previous errors
            document.querySelectorAll(".input-error").forEach(el => el.remove());

            let isValid = true;

            function showError(input, message) {
                const error = document.createElement("p");
                error.className = "input-error text-sm text-red-500 mt-1";
                error.innerText = message;
                input.parentNode.appendChild(error);
                isValid = false;
            }

            // Full name validation
            if (!fullName.value.trim()) {
                showError(fullName, "Full name is required.");
            } else if (fullName.value.trim().length < 3) {
                showError(fullName, "Full name must be at least 3 characters.");
            }

            // Strong email validation
            const emailPattern = /^[a-zA-Z0-9]+([._%+-]?[a-zA-Z0-9]+)*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!email.value.trim()) {
                showError(email, "Email address is required.");
            } else if (!emailPattern.test(email.value.trim())) {
                showError(email, "Invalid email format. Please include '@' and a valid domain.");
            }


            // Current password validation
            if (!currentPassword.value.trim()) {
                showError(currentPassword, "Current password is required.");
            }

            // New password validation
            if (!newPassword.value.trim()) {
                showError(newPassword, "New password is required.");
            } else if (newPassword.value.trim().length < 8) {
                showError(newPassword, "New password must be at least 8 characters.");
            }

            // Confirm password validation
            if (!confirmPassword.value.trim()) {
                showError(confirmPassword, "Confirm password is required.");
            } else if (confirmPassword.value !== newPassword.value) {
                showError(confirmPassword, "Passwords do not match.");
            }

            // Prevent same current and new password
            if (currentPassword.value && newPassword.value && currentPassword.value === newPassword.value) {
                showError(newPassword, "New password must be different from current password.");
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>

@endsection