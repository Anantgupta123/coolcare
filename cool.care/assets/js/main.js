// Main JavaScript file for Cool Care website

// Service card click handler
document.addEventListener('DOMContentLoaded', function() {
    // Handle service card clicks
    const serviceCards = document.querySelectorAll('.service-card');
    serviceCards.forEach(card => {
        card.addEventListener('click', function() {
            const service = this.getAttribute('data-service');
            const serviceSelect = document.getElementById('service');
            serviceSelect.value = service;

            // Scroll to booking form
            document.getElementById('home').scrollIntoView({ behavior: 'smooth' });
        });
    });

    // Handle booking form submission
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            // Basic validation
            const name = formData.get('name').trim();
            const phone = formData.get('phone').trim();

            if (!name || !phone) {
                alert('Please fill in all required fields.');
                return;
            }

            // Submit form via AJAX
            fetch('backend/save-request.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Service request submitted successfully!');
                    bookingForm.reset();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });
    }

    // Smooth scrolling for navbar links
    const navbarLinks = document.querySelectorAll('.navbar-nav .nav-link[href^="#"]');
    navbarLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});
