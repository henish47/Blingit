  // This function can be called globally by the onclick attribute
    const eyeIconSvg = {
        open: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`,
        closed: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 .946-3.11 3.586-5.447 6.834-6.25M17.953 5.447A9.96 9.96 0 0121.542 12c-1.274 4.057-5.064 7-9.542 7a9.96 9.96 0 01-2.553-.447m-4.498-4.498L3 8.5m18 0l-2.047-2.047M12 12a3 3 0 11-6 0 3 3 0 016 0z" />`
    };

    function togglePasswordVisibility(fieldId) {
        const input = document.getElementById(fieldId);
        const icon = document.getElementById(`eye-icon-${fieldId}`);
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = eyeIconSvg.closed;
        } else {
            input.type = 'password';
            icon.innerHTML = eyeIconSvg.open;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('login-form');
        const emailInput = document.getElementById('login-email');
        const passwordInput = document.getElementById('login-password');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            let isEmailValid = validateEmail();
            let isPasswordValid = validatePassword();

            if (isEmailValid && isPasswordValid) {
                form.submit();
            }
        });

        // --- Validation Functions ---
        function validateEmail() {
            const email = emailInput.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email === '') {
                showError(emailInput, emailError, 'Email address is required.');
                return false;
            } else if (!emailRegex.test(email)) {
                showError(emailInput, emailError, 'Please enter a valid email address.');
                return false;
            } else {
                hideError(emailInput, emailError);
                return true;
            }
        }

        function validatePassword() {
            const password = passwordInput.value;
            if (password === '') {
                showError(passwordInput, passwordError, 'Password is required.');
                return false;
            }
            // You can add more complex password rules here if needed
            hideError(passwordInput, passwordError);
            return true;
        }

        // --- Helper Functions to show/hide errors ---
        function showError(inputElement, errorElement, message) {
            inputElement.classList.add('border-red-500');
            inputElement.classList.remove('border-gray-300');
            errorElement.textContent = message;
        }

        function hideError(inputElement, errorElement) {
            inputElement.classList.remove('border-red-500');
            inputElement.classList.add('border-gray-300');
            errorElement.textContent = '';
        }

        // Add real-time validation as the user types
        emailInput.addEventListener('input', validateEmail);
        passwordInput.addEventListener('input', validatePassword);
    });