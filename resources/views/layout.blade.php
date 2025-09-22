<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blingit Grocery')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--
    <script src="https://cdn.tailwindcss.com"></script> --}}

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/4.1.0/tailwind.min.css" />

    <!-- Font Awesome for Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Poppins font for a modern, clean look */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #f0fff4 0%, #fffde4 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Custom Blingit styles for consistent branding */
        .bling-shadow {
            box-shadow: 0 4px 24px 0 rgba(34, 197, 94, 0.08), 0 1.5px 4px 0 rgba(251, 191, 36, 0.12);
        }

        .bling-gradient {
            background: linear-gradient(90deg, #faffd1 0%, #a1ffce 100%);
        }

        .bling-btn {
            background: linear-gradient(90deg, #faffd1 0%, #a1ffce 100%);
            color: #166534;
            /* Dark green text */
            font-weight: 600;
            border: none;
            transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .bling-btn:hover {
            box-shadow: 0 4px 12px 0 rgba(34, 197, 94, 0.2), 0 2px 6px 0 rgba(251, 191, 36, 0.15);
            transform: translateY(-3px) scale(1.02);
        }

        .bling-link {
            transition: color 0.2s ease-in-out, text-decoration 0.2s ease-in-out;
            color: #10B981;
        }

        .bling-link:hover {
            color: #059669;
            text-decoration: underline;
        }

        .bling-badge {
            background: linear-gradient(90deg, #faffd1 0%, #fbbf24 100%);
            color: #166534;
            font-weight: bold;
            box-shadow: 0 1px 4px 0 rgba(251, 191, 36, 0.18);
        }

        .blingit-logo-text {
            font-family: 'Montserrat', 'Poppins', sans-serif;
        }

        .modal {
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
        }

        /* Dynamic navbar styles */
        .user-menu {
            position: relative;
        }

        .user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .user-menu:hover .user-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .user-dropdown a,
        .user-dropdown button {
            display: block;
            width: 100%;
            text-align: left;
            padding: 12px 16px;
            color: #374151;
            text-decoration: none;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid #f3f4f6;
        }

        .user-dropdown a:last-child,
        .user-dropdown button:last-child {
            border-bottom: none;
        }

        .user-dropdown a:hover,
        .user-dropdown button:hover {
            background-color: #f9fafb;
            color: #10B981;
        }

        /* user-avatar class has been updated to support img tag */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .ai-fab {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #22c55e, #facc15);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
            z-index: 1000;
            text-decoration: none;
        }

        .ai-fab:hover {
            transform: scale(1.1) rotate(10deg);
            box-shadow: 0 8px 25px rgba(34, 197, 94, 0.3);
            color: white;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-transparent min-h-screen flex flex-col">
    @if (!Route::is('login') && !Route::is('register'))
        <header class="bling-gradient bling-shadow sticky top-0 z-50 border-b border-green-100 py-4">
            <div class="container mx-auto flex items-center justify-between px-4 sm:px-6 lg:px-8">
                <!-- Logo + Delivery Info -->
                <div class="flex items-center gap-4">
                    <a href="/" class="flex items-center gap-1 group">
                        <span class="text-3xl font-extrabold px-3 py-1 rounded-lg shadow-lg blingit-logo-text"
                            style="background-color: #FFFF00;">
                            <span class="text-black">bling</span><span class="text-green-600">it</span>
                        </span>
                        <span
                            class="text-sm font-semibold text-green-700 bg-green-100 px-3  py-1 rounded-full shadow-sm hidden sm:inline-flex animate-pulse group-hover:animate-none">
                            🚴 Delivery in 8 minutes
                        </span>
                    </a>
                </div>

                <!-- Search Bar (Desktop) -->
                <div class="hidden md:flex flex-1 justify-center px-5">
                    <div class="relative w-full max-w-xl">
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                            <i class="fa fa-search text-green-500 text-lg"></i>
                        </div>
                        <input type="text" placeholder="Search fruits, snacks, daily needs..."
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-green-300 focus:outline-none focus:ring-2 focus:ring-green-400 bg-white shadow-lg text-base transition focus:shadow-xl" />
                    </div>
                </div>

                <!-- Dynamic Navigation Based on Auth Status -->
                <div class="flex items-center gap-4">
                    <!-- Cart Icon (Always Visible) -->
                    <a href="/cart"
                        class="relative group text-green-700 hover:text-green-900 transition-colors duration-200 flex items-center">
                        <!-- Cart Icon -->
                        <div class="relative">
                            <i class="fa fa-shopping-cart text-3xl sm:text-2xl"></i>

                            <!-- Animated Badge -->
                            <span
                                class="bling-badge absolute -top-2 -right-3 bg-green-600 text-white text-xs font-semibold px-2 py-0.5 rounded-full shadow-lg transform scale-100 transition-all duration-300 ease-in-out group-hover:scale-110">
                                @auth
                                    {{ \App\Models\CartItem::where('user_id', Auth::id())->sum('quantity') }}
                                @else
                                    {{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }}
                                @endauth
                            </span>
                        </div>

                        <!-- Optional Label -->
                        <span
                            class="hidden sm:inline ml-2 font-semibold text-green-800 group-hover:text-green-900 transition-colors duration-200">
                            Cart
                        </span>
                    </a>




                    @auth
                        <!-- Logged In User Menu -->
                        <div class="user-menu">
                            <div class="flex items-center gap-3 cursor-pointer">
                                <!-- User Avatar -->
                                <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=FFFFFF&background=10B981' }}"
                                    alt="{{ Auth::user()->name }}'s Avatar" class="user-avatar">
                                <div class="hidden md:block text-left">
                                    <div class="text-sm font-semibold text-green-800">
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div class="text-xs text-green-600 capitalize">
                                        {{ Auth::user()->role }}
                                    </div>
                                </div>
                                <i class="fa fa-chevron-down text-green-600 text-sm"></i>
                            </div>

                            <!-- User Dropdown Menu -->
                            <div class="user-dropdown">
                                <a href="/edit_profile" class="flex items-center gap-2">
                                    <i class="fa fa-user"></i>
                                    My Profile
                                </a>
                                <a href="/orders" class="flex items-center gap-2">
                                    <i class="fa fa-shopping-bag"></i>
                                    My Orders
                                </a>
                                <hr class="my-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-2 text-red-600 hover:text-red-700">
                                        <i class="fa fa-sign-out-alt"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth

                    @guest
                        <!-- Guest User Menu -->
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}"
                                class="hidden md:inline-block px-5 py-2 rounded-full bling-btn shadow-md hover:scale-105 transition-transform">
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                                class="hidden md:inline-block px-5 py-2 rounded-full border-2 border-green-600 text-green-700 bg-white hover:bg-green-50 shadow-md transition-colors">
                                Register
                            </a>
                        </div>
                    @endguest

                    <!-- Mobile Menu Button -->
                    <button
                        class="md:hidden p-2 bg-green-100 rounded-full border border-green-200 shadow-sm hover:bg-green-200 transition"
                        id="mobileMenuBtn">
                        <i class="fa fa-bars text-green-600 text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Search (Visible on small screens) -->
            <div class="block md:hidden px-4 pb-4 pt-2">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                        <i class="fa fa-search text-green-500 text-base"></i>
                    </div>
                    <input type="text" placeholder="Search..."
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-green-300 focus:outline-none focus:ring-2 focus:ring-green-400 bg-white shadow text-base" />
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="md:hidden hidden px-4 pb-4">
                <nav class="flex flex-col gap-2 bg-white rounded-lg shadow-lg p-4 border border-gray-100">
                    <a href="/" class="py-2 px-3 rounded bling-link hover:bg-green-50 font-medium">Home</a>
                    <a href="/shop" class="py-2 px-3 rounded bling-link hover:bg-green-50 font-medium">Shop</a>
                    <a href="{{ url('/ai') }}"
                        class="py-2 px-3 rounded bling-link hover:bg-green-50 font-medium flex items-center gap-2">
                        <i class="fa-solid fa-robot"></i> AI Assistant
                    </a>
                    <a href="/cart"
                        class="py-2 px-3 rounded bling-link hover:bg-green-50 flex items-center gap-2 font-medium">
                        <i class="fa fa-shopping-cart"></i> Cart
                        <span class="ml-1 bling-badge text-xs px-2 py-0.5 rounded-full">3</span>
                    </a>

                    @auth
                        <!-- Mobile Logged In Menu -->
                        <hr class="my-2">
                        <div class="py-2 px-3 text-sm text-gray-600">
                            <div class="font-semibold">{{ Auth::user()->name }}</div>
                            <div class="text-xs capitalize">{{ Auth::user()->role }}</div>
                        </div>

                        <a href="/profile" class="py-2 px-3 rounded bling-link hover:bg-green-50 font-medium">
                            <i class="fa fa-user mr-2"></i>My Profile
                        </a>
                        <a href="/orders" class="py-2 px-3 rounded bling-link hover:bg-green-50 font-medium">
                            <i class="fa fa-shopping-bag mr-2"></i>My Orders
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left py-2 px-3 rounded text-red-600 hover:bg-red-50 font-medium">
                                <i class="fa fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    @endauth

                    @guest
                        <!-- Mobile Guest Menu -->
                        <a href="{{ route('login') }}"
                            class="py-2 px-3 rounded bling-link hover:bg-green-50 font-medium">Login</a>
                        <a href="{{ route('register') }}"
                            class="py-2 px-3 rounded bling-link hover:bg-green-50 font-medium">Register</a>
                    @endguest
                </nav>
            </div>
        </header>
    @endif

    <main class="flex-1">
        @yield('content')
    </main>

    @if (!Route::is('login') && !Route::is('register') && !Route::is('ai.chat'))
        <a href="{{ url('/ai') }}" class="ai-fab" title="Ask Gemini AI">
            <i class="fa-solid fa-robot"></i>
        </a>
    @endif

    @if (!Route::is('login') && !Route::is('register'))
        <footer class="bling-gradient border-t border-yellow-200 mt-16 relative bling-shadow">
            <!-- Background Texture -->
            <div class="absolute inset-0 opacity-10"
                style="background-image: url('https://www.transparenttextures.com/patterns/food.png'); pointer-events: none;">
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10 grid md:grid-cols-4 gap-10">
                <!-- Brand & Social -->
                <div class="flex flex-col gap-4 items-start">
                    <a href="/" class="flex items-center group">
                        <span class="text-3xl font-extrabold px-3 py-1 rounded-lg shadow-lg blingit-logo-text"
                            style="background-color: #FFFF00;">
                            <span class="text-black">bling</span><span class="text-green-600">it</span>
                        </span>
                    </a>
                    <p class="text-green-800 font-medium leading-relaxed">
                        Fresh groceries, delivered fast to your doorstep. Quality and convenience, always.
                    </p>
                    <div class="flex gap-3 mt-1">
                        <a href="#"
                            class="bg-white p-2 rounded-full text-green-700 hover:text-green-900 shadow hover:scale-110 transition-transform duration-200 ease-in-out"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#"
                            class="bg-white p-2 rounded-full text-green-700 hover:text-green-900 shadow hover:scale-110 transition-transform duration-200 ease-in-out"><i
                                class="fab fa-twitter"></i></a>
                        <a href="#"
                            class="bg-white p-2 rounded-full text-green-700 hover:text-green-900 shadow hover:scale-110 transition-transform duration-200 ease-in-out"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <!-- Company Links -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b-2 border-green-300 pb-2 inline-block ">
                        Links</h4>
                    <ul class="space-y-3 text-green-700">
                        <li><a href="/" class="bling-link font-medium">Home</a></li>
                        <li><a href="/about" class="bling-link font-medium">About Us</a></li>
                        <li><a href="/contact" class="bling-link font-medium">Contact us</a></li>
                        <li><a href="/cart" class="bling-link font-medium">Cart</a></li>
                        <li><a href="/login" class="bling-link font-medium">Login</a></li>
                    </ul>
                </div>

                <!-- Customer Support -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b-2 border-green-300 pb-2 inline-block">
                        Customer Service</h4>
                    <ul class="space-y-3 text-green-700">
                        <li><a href="#" class="bling-link font-medium" data-bs-toggle="modal"
                                data-bs-target="#faqModal">Help Center & FAQs</a></li>
                        <li><a href="#" class="bling-link font-medium" data-bs-toggle="modal"
                                data-bs-target="#shippingModal">Shipping & Delivery Info</a></li>
                        <li><a href="#" class="bling-link font-medium" data-bs-toggle="modal"
                                data-bs-target="#privacyModal">Privacy Policy</a></li>
                        <li><a href="#" class="bling-link font-medium" data-bs-toggle="modal"
                                data-bs-target="#termsModal">Terms of Service</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b-2 border-green-300 pb-2 inline-block">
                        Connect With Us</h4>
                    <ul class="space-y-3 text-green-800 text-sm">
                        <li class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-green-600 text-xl"></i>
                            123, Fresh Market Street, Marketing yard, Rajkot, India</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-phone text-green-600 text-xl"></i> +91
                            98765 43210 (24/7 Support)</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-envelope text-green-600 text-xl"></i>
                            support@blingit.com</li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="border-t border-yellow-200 text-center py-4 text-sm text-gray-600 bg-yellow-50 relative z-10">
                &copy; {{ date('Y') }} Blingit. All rights reserved.
            </div>
        </footer>
    @endif


    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function (e) {
                if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });
        }
    </script>

    @stack('script')

</body>

</html>