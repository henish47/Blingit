document.addEventListener('DOMContentLoaded', function () {
    const reviewForm = document.getElementById('review-form');
    const starsContainer = document.getElementById('star-rating');
    const stars = starsContainer.querySelectorAll('.star');
    const starError = document.getElementById('star-rating-error');
    const textarea = document.getElementById('review-textarea');
    const textareaError = document.getElementById('review-textarea-error');
    let currentRating = 0;

    // --- Star Rating Interaction ---
    stars.forEach(star => {
        star.addEventListener('mouseenter', () => {
            if (currentRating === 0) { // Only show hover effect if no rating is selected
                highlightStars(star.dataset.value);
            }
        });

        star.addEventListener('mouseleave', () => {
            if (currentRating === 0) { // Return to default state if no rating is selected
                highlightStars(0);
            } else {
                highlightStars(currentRating); // Keep selected rating highlighted
            }
        });

        star.addEventListener('click', () => {
            currentRating = star.dataset.value;
            highlightStars(currentRating);
            validateStars(); // Validate as soon as a star is clicked
        });
    });

    function highlightStars(rating) {
        stars.forEach(star => {
            if (star.dataset.value <= rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
    }

    // --- Validation Logic ---
    function validateStars() {
        if (currentRating === 0) {
            starError.textContent = 'Please select a rating.';
            return false;
        }
        starError.textContent = '';
        return true;
    }

    function validateTextarea() {
        if (textarea.value.trim() === '') {
            textareaError.textContent = 'Please share your feedback in the text box.';
            textarea.classList.add('border-red-500');
            return false;
        }
        textareaError.textContent = '';
        textarea.classList.remove('border-red-500');
        return true;
    }

    // Real-time validation for textarea
    textarea.addEventListener('input', validateTextarea);

    // --- Form Submission ---
    reviewForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const isStarsValid = validateStars();
        const isTextareaValid = validateTextarea();

        if (isStarsValid && isTextareaValid) {
            console.log('Review Submitted:', { rating: currentRating, feedback: textarea.value });
            // Here you would typically send the data to your server
            alert('Thank you for your feedback!');
            reviewForm.reset();
            currentRating = 0;
            highlightStars(0);
        } else {
            console.log('Review form is invalid.');
        }
    });
});