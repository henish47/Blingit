<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #fefce8;
        }

        ::-webkit-scrollbar-thumb {
            background: #d4d4d4;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a3a3a3;
        }
    </style>
</head>

<body class="bg-yellow-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="admin-sidebar"
            class="fixed inset-y-0 left-0 w-64 bg-white border-r border-yellow-200 z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col shadow-lg">
            <!-- Logo -->
            <div
                class="flex items-center justify-center px-6 py-4 border-b border-yellow-200 h-20 bg-gradient-to-r from-yellow-50 to-green-50">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <span class="text-3xl font-extrabold px-3 py-1 rounded-lg shadow-lg"
                        style="font-family: 'Montserrat', 'Poppins', sans-serif; background-color: #FFFF00;">
                        <span class="text-black">bling</span><span class="text-green-600">it</span>
                    </span>
                </a>
            </div>
            <!-- Sidebar Navigation -->
            <nav class="flex-1 px-4 py-4 overflow-y-auto">
                <ul class="space-y-1">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->routeIs('admin.dashboard')) bg-green-100 text-green-800 font-bold shadow-sm @endif"><i
                                class="fas fa-grid-2 text-lg w-5 h-5 text-center"></i> Dashboard</a></li>
                    <li><a href="{{ route('categories.index') }}"
                            class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->routeIs('categories.*')) bg-green-100 text-green-800 font-bold shadow-sm @endif"><i
                                class="fas fa-layer-group text-lg w-5 h-5 text-center"></i> Categories</a></li>
                    <li><a href="{{ route('products.index') }}"
                            class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->routeIs('products.*')) bg-green-100 text-green-800 font-bold shadow-sm @endif"><i
                                class="fas fa-box-open text-lg w-5 h-5 text-center"></i> Products</a></li>
                    <li><a href="{{ route('banners.index') }}"
                            class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->routeIs('banners.*')) bg-green-100 text-green-800 font-bold shadow-sm @endif"><i
                                class="fas fa-images text-lg w-5 h-5 text-center"></i> Banners</a></li>
                    <li><a href="{{ route('coupons.index') }}"
                            class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->routeIs('coupons.*')) bg-green-100 text-green-800 font-bold shadow-sm @endif"><i
                                class="fas fa-tag text-lg w-5 h-5 text-center"></i> Coupons</a></li>
                    <li><a href="{{ route('admin.orders') }}"
                            class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->routeIs('admin.orders')) bg-green-100 text-green-800 font-bold shadow-sm @endif"><i
                                class="fas fa-shopping-bag text-lg w-5 h-5 text-center"></i> Orders</a></li>
                    <li><a href="{{ route('users.index') }}"
                            class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->routeIs('users.*')) bg-green-100 text-green-800 font-bold shadow-sm @endif"><i
                                class="fas fa-users text-lg w-5 h-5 text-center"></i> Users</a></li>
                    <li><a href="{{ route('admin.contact') }}"
                            class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->routeIs('admin.contact')) bg-green-100 text-green-800 font-bold shadow-sm @endif"><i
                                class="fas fa-envelope text-lg w-5 h-5 text-center"></i> Messages</a></li>
                    <li><a href="{{ route('notifications.create') }}"
                            class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->routeIs('notifications.*')) bg-green-100 text-green-800 font-bold shadow-sm @endif"><i
                                class="fas fa-bell text-lg w-5 h-5 text-center"></i> Notifications</a></li>
                </ul>
            </nav>
            <div class="mt-auto p-4 text-xs text-gray-400 text-center border-t border-yellow-200">&copy; {{ date('Y') }}
                Blingit Admin</div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 md:ml-64">
            <!-- Top Navbar -->
            <header
                class="bg-white/80 backdrop-blur-lg border-b border-yellow-200 flex items-center justify-between px-4 sm:px-6 h-20 shadow-sm sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button id="sidebar-open" class="md:hidden text-gray-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h1 class="text-lg md:text-xl font-semibold text-gray-800 truncate">
                        @yield('title', 'Admin Dashboard')</h1>
                </div>

                <!-- User Dropdown -->
                @auth
                    <div class="relative">
                        <button id="userDropdownBtn"
                            class="flex items-center gap-3 focus:outline-none p-2 rounded-lg hover:bg-yellow-50 transition-colors">
                            <img src="{{ Auth::user()->profile_photo_url }}"
                                 alt="{{ Auth::user()->name }} Avatar"
                                 class="w-10 h-10 rounded-full border-2 border-white shadow-md object-cover">
                            <div class="text-left hidden sm:block">
                                <span class="text-gray-800 font-semibold text-sm">{{ Auth::user()->name }}</span>
                                <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role ?? 'User' }}</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-500 hidden sm:block" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="userDropdownMenu"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 hidden ring-1 ring-black/5">
                            <a href="{{ route('admin.profile.index') }}"
                                class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-green-50 transition-colors duration-200">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-green-50 transition-colors duration-200 border-t border-slate-100">
                                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </header>

            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <div class="mx-auto w-full">
                    @yield('content')
                </div>
            </main>
        </div>
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-40 z-40 hidden md:hidden"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const openBtn = document.getElementById('sidebar-open');
            const userDropdownBtn = document.getElementById('userDropdownBtn');
            const userDropdownMenu = document.getElementById('userDropdownMenu');

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }

            if (openBtn) openBtn.addEventListener('click', toggleSidebar);
            if (overlay) overlay.addEventListener('click', toggleSidebar);

            if (userDropdownBtn) {
                userDropdownBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    userDropdownMenu.classList.toggle('hidden');
                });
            }

            document.addEventListener('click', function (e) {
                if (userDropdownBtn && userDropdownMenu && !userDropdownBtn.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                    userDropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>