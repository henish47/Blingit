@extends('layout')

@section('title', 'Edit Profile | Blingit Grocery')

@section('content')

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .profile-card {
            transition: all 0.3s ease;
            background-color: #fff;
        }
        .profile-input {
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            background-color: #fff;
        }
        .profile-input.border-red-500 {
            border-color: #ef4444;
        }
        .profile-input:hover {
            border-color: #22c55e;
            box-shadow: 0 0 8px rgba(34, 197, 94, 0.2);
        }
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
        .btn-custom:hover {
            opacity: 0.9;
        }
        .profile-input:focus {
            outline: none;
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
        }
        .section-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
    </style>

    <div class="bg-gray-50 min-h-screen py-10">
        <div class="container mx-auto px-4">
            <div class="text-center md:text-left mb-8">
                <h1 class="text-4xl font-extrabold text-gray-800 mb-2">Edit Your Profile</h1>
                <p class="text-gray-500">Keep your personal information up to date.</p>
            </div>

            <!-- Flash Messages -->
            <div id="ajax-message" class="hidden mb-6 p-4 rounded-lg"></div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-2xl shadow-lg text-center profile-card">
                        <div class="image-upload-container mx-auto mb-4"
                             onclick="document.getElementById('profile-pic-upload').click()">
                            <img id="profile-pic-preview" src="{{ $user->profile_photo_url }}" alt="Profile Picture">
                            <div class="upload-icon">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mt-2">{{ $user->name }}</h2>
                        <p class="text-gray-500 mb-2">{{ $user->email }}</p>
                        <p class="text-sm text-gray-400">Joined on: {{ $user->created_at->format('F j, Y') }}</p>
                    </div>
                </div>

                <!-- Right Form Section -->
                <div class="lg:col-span-2">
                    <form id="profile-update-form" action="{{ route('profile.update') }}" method="POST"
                          class="space-y-8 bg-white p-8 rounded-2xl shadow-lg"
                          enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PATCH')

                        <!-- Hidden Profile Photo Input -->
                        <input type="file" name="profile_photo" id="profile-pic-upload"
                               class="hidden" accept="image/*" onchange="previewImage(event)">

                        <!-- Personal Information -->
                        <div>
                            <div class="section-header mb-6 border-b pb-4">
                                <i class="fas fa-user-circle text-green-600 text-xl"></i>
                                <h3 class="text-xl font-bold text-gray-800">Personal Information</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg profile-input" required>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg profile-input" required>
                                </div>
                            </div>
                        </div>

                        <!-- Change Password -->
                        <div>
                            <div class="section-header mb-6 border-b pb-4">
                                <i class="fas fa-lock text-green-600 text-xl"></i>
                                <h3 class="text-xl font-bold text-gray-800">Change Password</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="old_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                    <input type="password" id="old_password" name="old_password"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg profile-input"
                                           placeholder="Enter current password">
                                </div>
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                    <input type="password" id="password" name="password"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg profile-input"
                                           placeholder="Enter new password">
                                </div>
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg profile-input"
                                           placeholder="Confirm new password">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 mt-6">
                            <a href="{{ route('edit_profile') }}"
                               class="px-8 py-3 text-sm font-semibold rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 transition btn-custom">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-8 py-3 text-sm font-semibold rounded-lg border-2 border-green-600 text-white bg-green-600 hover:bg-green-700 transition shadow-md btn-custom">
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
    // Image preview before upload
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('profile-pic-preview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const profileForm = document.getElementById('profile-update-form');
        const ajaxMessage = document.getElementById('ajax-message');

        profileForm.addEventListener('submit', function (e) {
            e.preventDefault();
            clearErrors();

            let formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    ajaxMessage.className = "mb-6 p-4 rounded-lg bg-green-100 border-l-4 border-green-500 text-green-700";
                    ajaxMessage.innerHTML = `<p class="font-bold">Success!</p><p>${data.message}</p>`;
                    ajaxMessage.classList.remove('hidden');

                    // Update UI
                    if (data.user.profile_photo_url) {
                        document.getElementById('profile-pic-preview').src = data.user.profile_photo_url;
                    }
                } else {
                    ajaxMessage.className = "mb-6 p-4 rounded-lg bg-red-100 border-l-4 border-red-500 text-red-700";
                    ajaxMessage.innerHTML = `<p class="font-bold">Error!</p><p>${data.message}</p>`;
                    ajaxMessage.classList.remove('hidden');
                }
            })
            .catch(err => {
                console.error(err);
                ajaxMessage.className = "mb-6 p-4 rounded-lg bg-red-100 border-l-4 border-red-500 text-red-700";
                ajaxMessage.innerHTML = `<p class="font-bold">Error!</p><p>Something went wrong. Please try again.</p>`;
                ajaxMessage.classList.remove('hidden');
            });
        });

        function clearErrors() {
            ajaxMessage.innerHTML = '';
            ajaxMessage.classList.add('hidden');
        }
    });
</script>
@endpush
