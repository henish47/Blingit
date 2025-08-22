        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('send-otp-form');
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('email-error');

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent default form submission
                
                if (validateEmail()) {
                    console.log('Validation successful. Redirecting for email:', emailInput.value);
                    // On a real server, you would now make an API call to send the OTP.
                    // For this demo, we'll redirect as originally intended.
                    window.location.href = '/otp-verify';
                } else {
                    console.log('Validation failed.');
                }
            });

            function validateEmail() {
                const email = emailInput.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const gmailRegex = /@gmail\.com$/;

                if (email === '') {
                    showError('Gmail address is required.');
                    return false;
                } else if (!emailRegex.test(email)) {
                    showError('Please enter a valid email address.');
                    return false;
                } else if (!gmailRegex.test(email)) {
                    showError('Please enter a valid @gmail.com address.');
                    return false;
                } else {
                    hideError();
                    return true;
                }
            }

            function showError(message) {
                emailInput.classList.add('border-red-500');
                emailInput.classList.remove('border-gray-300');
                emailError.textContent = message;
            }

            function hideError() {
                emailInput.classList.remove('border-red-500');
                emailInput.classList.add('border-gray-300');
                emailError.textContent = '';
            }

            // Add real-time validation as the user types
            emailInput.addEventListener('input', validateEmail);
        });