<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blingit Grocery')</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @vite('resources/css/app.css')
    <!-- Tailwind CSS CDN -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> --}}
    
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
            box-shadow: 0 4px 24px 0 rgba(34,197,94,0.08), 0 1.5px 4px 0 rgba(251,191,36,0.12);
        }
        .bling-gradient {
            background: linear-gradient(90deg, #faffd1 0%, #a1ffce 100%);
        }
        .bling-btn {
            background: linear-gradient(90deg, #faffd1 0%, #a1ffce 100%);
            color: #166534; /* Dark green text */
            font-weight: 600;
            border: none;
            transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
        }
        .bling-btn:hover {
            box-shadow: 0 4px 12px 0 rgba(34,197,94,0.2), 0 2px 6px 0 rgba(251,191,36,0.15);
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
            box-shadow: 0 1px 4px 0 rgba(251,191,36,0.18);
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
                    <span class="text-sm font-semibold text-green-700 bg-green-100 px-3 py-1 rounded-full shadow-sm hidden sm:inline-flex animate-pulse group-hover:animate-none">
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

            <!-- Cart & Login -->
            <div class="flex items-center gap-4">
                <a href="/cart" class="relative group text-green-700 hover:text-green-900 transition-colors duration-200">
                    <i class="fa fa-shopping-cart text-2xl"></i>
                    <span class="bling-badge absolute -top-1 -right-2 text-xs px-2 py-0.5 rounded-full">
                        2
                    </span>
                </a>
                <a href="/login"
                    class="hidden md:inline-block px-5 py-2 rounded-full bling-btn shadow-md">
                    Login
                </a>
                <button class="md:hidden p-2 bg-green-100 rounded-full border border-green-200 shadow-sm hover:bg-green-200 transition" id="mobileMenuBtn">
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
                <a href="/cart" class="py-2 px-3 rounded bling-link hover:bg-green-50 flex items-center gap-2 font-medium">
                    <i class="fa fa-shopping-cart"></i> Cart
                    <span class="ml-1 bling-badge text-xs px-2 py-0.5 rounded-full">2</span>
                </a>
                <a href="/login" class="py-2 px-3 rounded bling-link hover:bg-green-50 font-medium">Login</a>
            </nav>
        </div>
    </header>
    @endif

    <main class="flex-1">
        @yield('content')
    </main>

    @if (!Route::is('login') && !Route::is('register'))
    <footer class="bling-gradient border-t border-yellow-200 mt-16 relative bling-shadow">
    <!-- Background Texture -->
    <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/food.png'); pointer-events: none;"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10 grid md:grid-cols-4 gap-10">
        <!-- Brand & Social -->
        <div class="flex flex-col gap-4 items-start">
            <a href="/" class="flex items-center group">
                <span class="text-3xl font-extrabold px-3 py-1 rounded-lg shadow-lg blingit-logo-text" style="background-color: #FFFF00;">
                    <span class="text-black">bling</span><span class="text-green-600">it</span>
                </span>
            </a>
            <p class="text-green-800 font-medium leading-relaxed">
                Fresh groceries, delivered fast to your doorstep. Quality and convenience, always.
            </p>
            <div class="flex gap-3 mt-1">
                <a href="#" class="bg-white p-2 rounded-full text-green-700 hover:text-green-900 shadow hover:scale-110 transition-transform duration-200 ease-in-out"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="bg-white p-2 rounded-full text-green-700 hover:text-green-900 shadow hover:scale-110 transition-transform duration-200 ease-in-out"><i class="fab fa-twitter"></i></a>
                <a href="#" class="bg-white p-2 rounded-full text-green-700 hover:text-green-900 shadow hover:scale-110 transition-transform duration-200 ease-in-out"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <!-- Company Links -->
        <div>
            <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b-2 border-green-300 pb-2 inline-block">Company</h4>
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
            <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b-2 border-green-300 pb-2 inline-block">Customer Service</h4>
            <ul class="space-y-3 text-green-700">
                <li><a href="#" class="bling-link font-medium" data-bs-toggle="modal" data-bs-target="#faqModal">Help Center & FAQs</a></li>
                <li><a href="#" class="bling-link font-medium" data-bs-toggle="modal" data-bs-target="#shippingModal">Shipping & Delivery Info</a></li>
             
                <li><a href="#" class="bling-link font-medium" data-bs-toggle="modal" data-bs-target="#privacyModal">Privacy Policy</a></li>
                <li><a href="#" class="bling-link font-medium" data-bs-toggle="modal" data-bs-target="#termsModal">Terms of Service</a></li>
            </ul>
        </div>

        <!-- Contact Info -->
        <div>
            <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b-2 border-green-300 pb-2 inline-block">Connect With Us</h4>
            <ul class="space-y-3 text-green-800 text-sm">
                <li class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-green-600 text-xl"></i> 123, Fresh Market Street, Green City, Mumbai, India</li>
                <li class="flex items-center gap-3"><i class="fa-solid fa-phone text-green-600 text-xl"></i> +91 98765 43210 (24/7 Support)</li>
                <li class="flex items-center gap-3"><i class="fa-solid fa-envelope text-green-600 text-xl"></i> support@blingit.com</li>
            </ul>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="border-t border-yellow-200 text-center py-4 text-sm text-gray-600 bg-yellow-50 relative z-10">
        &copy; {{ date('Y') }} Blingit. All rights reserved.
    </div>
</footer>
    @endif
    
    <!-- MODALS -->
    <!-- FAQ Modal -->
    <div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-2xl font-bold text-gray-800" id="faqModalLabel">Help Center & FAQs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button font-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How fast is the delivery?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We pride ourselves on our 10-minute delivery promise for most locations within our service area. Delivery times may vary slightly based on traffic and order volume, but we always strive to be as fast as possible.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed font-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What are the delivery charges?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Delivery charges are a flat rate of ₹40 on all orders. We may offer free delivery promotions from time to time, so keep an eye on our app and website!
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed font-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How do I report an issue with my order?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    If you have any issues with your order, such as missing items or quality concerns, please contact our customer support immediately through the "Contact Us" section or call us at +91 98765 43210. We are available 24/7 to assist you.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shipping Modal -->
    <div class="modal fade" id="shippingModal" tabindex="-1" aria-labelledby="shippingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-2xl font-bold text-gray-800" id="shippingModalLabel">Shipping & Delivery Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="font-bold text-lg mb-2">Delivery Speed</h6>
                    <p>Our primary goal is to deliver your groceries within 10 minutes of placing an order. This service is available in all major areas of Mumbai, Rajkot, and other covered cities.</p>
                    <hr class="my-4">
                    <h6 class="font-bold text-lg mb-2">Delivery Charges</h6>
                    <p>A standard delivery fee of ₹40 is applied to every order to help cover the cost of our rapid delivery service. This ensures we can maintain our fleet and pay our delivery partners fairly.</p>
                    <hr class="my-4">
                    <h6 class="font-bold text-lg mb-2">Service Areas</h6>
                    <p>Currently, we operate in select metropolitan areas. You can check if your location is serviceable by entering your address on the home page or at checkout.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Privacy Policy Modal -->
    <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-2xl font-bold text-gray-800" id="privacyModalLabel">Privacy Policy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Your privacy is important to us. This Privacy Policy explains how Blingit collects, uses, and discloses your personal information...</p>
                    <h6 class="font-bold text-lg mt-4 mb-2">Information We Collect</h6>
                    <p>We collect information you provide directly to us, such as when you create an account, place an order, or contact customer support. This may include your name, email address, phone number, and delivery address.</p>
                    <h6 class="font-bold text-lg mt-4 mb-2">How We Use Information</h6>
                    <p>We use the information we collect to provide, maintain, and improve our services, including to process transactions, send delivery notifications, and respond to your comments and questions.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Terms of Service Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-2xl font-bold text-gray-800" id="termsModalLabel">Terms of Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>By accessing or using the Blingit service, you agree to be bound by these Terms of Service...</p>
                    <h6 class="font-bold text-lg mt-4 mb-2">Account Usage</h6>
                    <p>You must be at least 18 years old to use our service. You are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer.</p>
                    <h6 class="font-bold text-lg mt-4 mb-2">Prohibited Conduct</h6>
                    <p>You agree not to use the service for any unlawful purpose or in any way that could damage, disable, overburden, or impair our servers or networks.</p>
                </div>
            </div>
        </div>
    </div>


    <script>
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    }
    </script>

    @stack('script')