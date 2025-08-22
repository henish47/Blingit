import { animate } from "https://cdn.skypack.dev/motion";

    document.addEventListener('DOMContentLoaded', function () {
        // --- Page Load Animations ---
        const sequence = [
            ["#info-panel", { opacity: [0, 1], x: [-20, 0] }, { duration: 0.6, easing: "ease-out" }],
            [".info-item", { opacity: [0, 1], x: [-10, 0] }, { duration: 0.5, delay: animate.stagger(0.1), at: 0.3 }],
            ["#form-header", { opacity: [0, 1], y: [10, 0] }, { duration: 0.5, at: 0.2 }],
            ["#register-form > div", { opacity: [0, 1], y: [10, 0] }, { duration: 0.5, delay: animate.stagger(0.1), at: 0.4 }],
        ];
        animate(sequence);


        // --- Form Validation Logic ---
        const form = document.getElementById('register-form');
        const nameInput = document.getElementById('register-name');
        const emailInput = document.getElementById('register-email');
        const passwordInput = document.getElementById('register-password');
        const confirmPasswordInput = document.getElementById('password_confirmation');

        const nameError = document.getElementById('name-error');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');
        const confirmPasswordError = document.getElementById('confirm-password-error');

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            
            const isNameValid = validateName();
            const isEmailValid = validateEmail();
            const isPasswordValid = validatePassword();
            const isConfirmPasswordValid = validateConfirmPassword();

            if (isNameValid && isEmailValid && isPasswordValid && isConfirmPasswordValid) {
                form.submit();
            }
        });

        function validateName() {
            const name = nameInput.value.trim();
            const nameRegex = /^[a-zA-Z\s.'-]+$/; // Allows letters, spaces, and some special characters in names
            if (name === '') {
                showError(nameInput, nameError, 'Full name is required.');
                return false;
            } else if (!nameRegex.test(name)) {
                showError(nameInput, nameError, 'Please enter a valid name (letters and spaces only).');
                return false;
            } else {
                hideError(nameInput, nameError);
                return true;
            }
        }

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
            const errors = [];
            if (password.length < 8) errors.push('be at least 8 characters');
            if (!/[A-Z]/.test(password)) errors.push('contain an uppercase letter');
            if (!/[a-z]/.test(password)) errors.push('contain a lowercase letter');
            if (!/\d/.test(password)) errors.push('contain a number');
            if (!/[@$!%*?&]/.test(password)) errors.push('contain a special character');

            if (errors.length > 0) {
                showError(passwordInput, passwordError, 'Password must ' + errors.join(', ') + '.');
                return false;
            } else {
                hideError(passwordInput, passwordError);
                // Also re-validate the confirm password field if the main password changes
                validateConfirmPassword(); 
                return true;
            }
        }

        function validateConfirmPassword() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            if (confirmPassword === '') {
                showError(confirmPasswordInput, confirmPasswordError, 'Please confirm your password.');
                return false;
            } else if (password !== confirmPassword) {
                showError(confirmPasswordInput, confirmPasswordError, 'Passwords do not match.');
                return false;
            } else {
                hideError(confirmPasswordInput, confirmPasswordError);
                return true;
            }
        }

        function showError(input, errorEl, message) {
            input.classList.add('border-red-500');
            input.classList.remove('border-gray-300');
            errorEl.textContent = message;
        }

        function hideError(input, errorEl) {
            input.classList.remove('border-red-500');
            input.classList.add('border-gray-300');
            errorEl.textContent = '';
        }

        // Add real-time validation
        nameInput.addEventListener('input', validateName);
        emailInput.addEventListener('input', validateEmail);
        passwordInput.addEventListener('input', validatePassword);
        confirmPasswordInput.addEventListener('input', validateConfirmPassword);
    });