<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind CSS v3 -->
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
        /* Custom scrollbar for a consistent look */
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
        <aside id="admin-sidebar" class="fixed inset-y-0 left-0 w-64 bg-white border-r border-yellow-200 z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col shadow-lg">
            <!-- Logo -->
            <div class="flex items-center justify-center px-6 py-4 border-b border-yellow-200 h-20 bg-gradient-to-r from-yellow-50 to-green-50">
                <a href="/admin/dashboard" class="flex items-center gap-2">
                   <span class="text-3xl font-extrabold px-3 py-1 rounded-lg shadow-lg"
                         style="font-family: 'Montserrat', 'Poppins', sans-serif; background-color: #FFFF00;">
                        <span class="text-black">bling</span><span class="text-green-600">it</span>
                    </span>
                </a>
            </div>
            <!-- Sidebar Navigation -->
            <nav class="flex-1 px-4 py-4 overflow-y-auto">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->is('admin/dashboard')) bg-green-100 text-green-800 font-bold shadow-sm @endif">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a2 2 0 002 2h10a2 2 0 002-2V10M9 20h6"></path></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/categories') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->is('admin/categories')) bg-green-100 text-green-800 font-bold shadow-sm @endif">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/coupons') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->is('admin/coupons')) bg-green-100 text-green-800 font-bold shadow-sm @endif">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                            Coupons
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/orders') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->is('admin/orders')) bg-green-100 text-green-800 font-bold shadow-sm @endif">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            Orders
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/products') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->is('admin/products')) bg-green-100 text-green-800 font-bold shadow-sm @endif">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/users') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->is('admin/users')) bg-green-100 text-green-800 font-bold shadow-sm @endif">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197M15 21a6 6 0 006-6v-1a3 3 0 00-3-3H9a3 3 0 00-3 3v1a6 6 0 006 6z"></path></svg>
                            Users
                        </a>
                    </li>
                     <li>
                        <a href="{{ url('/admin/contact') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-lg font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 @if(request()->is('admin/contact')) bg-green-100 text-green-800 font-bold shadow-sm @endif">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Messages
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- Sidebar Footer -->
            <div class="mt-auto p-4 text-xs text-gray-400 text-center border-t border-yellow-200">
                &copy; {{ date('Y') }} Blingit Admin
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 md:ml-64">
            <!-- Top Navbar -->
            <header class="bg-white/80 backdrop-blur-lg border-b border-yellow-200 flex items-center justify-between px-4 sm:px-6 h-20 shadow-sm sticky top-0 z-30">
                <!-- Mobile Menu Button & Page Title -->
                <div class="flex items-center gap-4">
                    <button id="sidebar-open" class="md:hidden text-gray-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h1 class="text-lg md:text-xl font-semibold text-gray-800 truncate">@yield('title', 'Admin Dashboard')</h1>
                </div>

                <!-- User Dropdown -->
                @auth
                <div class="relative">
                    <button id="userDropdownBtn" class="flex items-center gap-3 focus:outline-none p-2 rounded-lg hover:bg-yellow-50 transition-colors">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=10b981&color=fff&rounded=true&size=40" alt="{{ Auth::user()->name }} Avatar" class="w-10 h-10 rounded-full border-2 border-white shadow-md">
                        <div class="text-left hidden sm:block">
                            <span class="text-gray-800 font-semibold text-sm">{{ Auth::user()->name }}</span>
                            <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role ?? 'User' }}</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-500 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div id="userDropdownMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 hidden ring-1 ring-black/5">
                        <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-green-50 transition-colors duration-200">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-green-50 transition-colors duration-200 border-t border-slate-100">
                               <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </header>
            
            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <div class="mx-auto w-full">
                    @yield('content')
                </div>
            </main>
        </div>
        <!-- Mobile Sidebar Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-40 z-40 hidden md:hidden"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                userDropdownBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdownMenu.classList.toggle('hidden');
                });
            }

            document.addEventListener('click', function(e) {
                if (userDropdownBtn && userDropdownMenu && !userDropdownBtn.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                    userDropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>

