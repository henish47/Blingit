@extends('admin.layout')

@section('title', 'My Profile')

@section('content')

    <div>
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800">My Profile</h1>
            <p class="text-gray-500 mt-1">Manage your profile details and update your password.</p>
        </div>

        @if(session('profile_success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ session('profile_success') }}</p>
            </div>
        @endif
        
        @if(session('password_success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ session('password_success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
                <p class="font-bold">Please fix the following errors:</p>
                <ul class="list-disc list-inside ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 text-center">
                    <form id="profilePhotoForm" method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="relative w-32 h-32 mx-auto group">
                            <img src="{{ Auth::user()->profile_photo_url }}"
                                 alt="{{ Auth::user()->name }} Avatar" class="w-32 h-32 rounded-full object-cover border-4 border-green-100 shadow-md">
                            <label for="profile_photo" 
                                   class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-sm font-semibold rounded-full opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                Change
                            </label>
                            <input type="file" name="profile_photo" id="profile_photo" class="hidden" onchange="document.getElementById('profilePhotoForm').submit();">
                            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                        </div>
                    </form>
                    <h2 class="text-2xl font-bold text-gray-800 mt-4">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <form id="profileForm" method="POST" action="{{ route('admin.profile.update') }}">
                        @csrf
                        @method('PATCH')
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Profile Information</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                        </div>
                        <div class="mt-8 text-right">
                            <button type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                     <form id="passwordForm" method="POST" action="{{ route('admin.profile.password.update') }}">
                        @csrf
                        @method('PATCH')
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Change Password</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                <input type="password" id="current_password" name="current_password"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                       placeholder="Enter your current password">
                            </div>
                            <div>
                                <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                <input type="password" id="new_password" name="new_password"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                       placeholder="Enter a new password">
                            </div>
                            <div>
                                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                       placeholder="Confirm your new password">
                            </div>
                        </div>
                        <div class="mt-8 text-right">
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection