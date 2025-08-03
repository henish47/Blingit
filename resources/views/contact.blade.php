@extends('layout')

@section('title', 'Contact Us | Blingit Grocery')

@section('content')

<div class="bg-gray-50 font-sans">
    <!-- Header Section -->
    <div class="bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">Get in Touch</h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-600">
                Have a question, feedback, or a brilliant idea? We're here to help and would love to hear from you!
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Left Column: Contact Form -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Send us a Message</h2>
                <form id="contactForm" class="space-y-6" novalidate>
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="John Doe" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="you@example.com" required>
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., Question about a product" required>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Write your message here..." required></textarea>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-0.5 text-lg flex items-center justify-center gap-2">
                            <span>Send Message</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Column: Contact Information -->
            <div class="space-y-8">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Contact Information</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="bg-green-100 p-3 rounded-full mt-1">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Email Us</h4>
                                <p class="text-gray-600 text-sm">support@blingit.com</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="bg-green-100 p-3 rounded-full mt-1">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Call Us</h4>
                                <p class="text-gray-600 text-sm">+91 98765 43210</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Our Office</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="bg-green-100 p-3 rounded-full mt-1">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Address</h4>
                                <p class="text-gray-600 text-sm">123, Market Street, Mumbai, Maharashtra, India - 400001</p>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ✅ JavaScript Validation Script -->
<script>
    document.getElementById('contactForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default submit

        let form = e.target;
        let name = form.name.value.trim();
        let email = form.email.value.trim();
        let subject = form.subject.value.trim();
        let message = form.message.value.trim();
        let isValid = true;

        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(el => el.remove());

        const showError = (input, message) => {
            const error = document.createElement('p');
            error.className = 'text-red-600 text-sm mt-1 error-message';
            error.innerText = message;
            input.insertAdjacentElement('afterend', error);
        };

        // Full Name validation
       
if (name.length < 3) {
        isValid = false;
        showError(form.name, 'Full name must be at least 3 characters.');
    } else if (!/^[a-zA-Z\s]+$/.test(name)) {
    isValid = false;
    showError(form.name, 'Full name should not contain numbers or special characters.');
    }

        // Email validation
        const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
        if (!emailPattern.test(email)) {
            isValid = false;
            showError(form.email, 'Enter a valid email address.');
        }

        // Subject validation
        if (subject.length < 5) {
            isValid = false;
            showError(form.subject, 'Subject must be at least 5 characters.');
        } else if (!/^[a-zA-Z\s]+$/.test(subject)) {
            isValid = false;
            showError(form.subject, 'Subject should contain only letters and spaces.');
        }

        // Message validation
        if (message.length < 10) {
            isValid = false;
            showError(form.message, 'Message must be at least 10 characters.');
        }

        if (isValid) {
            form.submit(); // Submit the form if everything is valid
        }
    });
</script>

@endsection
