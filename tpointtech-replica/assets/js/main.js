/**
 * TPoint Tech Replica - Main JavaScript File
 * Handles interactive features and UI enhancements
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Mobile navigation toggle (if needed in future)
    const navToggle = document.getElementById('navToggle');
    const mainNav = document.querySelector('nav ul');
    
    if (navToggle && mainNav) {
        navToggle.addEventListener('click', function() {
            mainNav.classList.toggle('show');
        });
    }
    
    // Add hover effects to cards
    const cards = document.querySelectorAll('.category-card, .tutorial-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Auto-hide flash messages after 5 seconds
    const flashMessages = document.querySelectorAll('.flash-message');
    flashMessages.forEach(message => {
        setTimeout(() => {
            message.style.opacity = '0';
            setTimeout(() => {
                message.remove();
            }, 300);
        }, 5000);
    });
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Add loading animation for forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"], input[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Loading...';
            }
        });
    });
    
    // Search functionality (basic implementation)
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();
            
            if (query.length >= 3) {
                searchTimeout = setTimeout(() => {
                    performSearch(query);
                }, 300);
            }
        });
    }
    
    // Basic search function
    function performSearch(query) {
        // This would typically make an AJAX request to search endpoint
        console.log('Searching for:', query);
        // Implementation would go here for actual search functionality
    }
    
    // Add click tracking for analytics
    const trackableElements = document.querySelectorAll('[data-track]');
    trackableElements.forEach(element => {
        element.addEventListener('click', function() {
            const trackData = this.getAttribute('data-track');
            // Send tracking data to analytics endpoint
            console.log('Tracking:', trackData);
        });
    });
    
    // Lazy loading for images
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
    
    // Add animation on scroll
    const animateOnScroll = document.querySelectorAll('.animate-on-scroll');
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
            }
        });
    });
    
    animateOnScroll.forEach(element => scrollObserver.observe(element));
    
    // Console welcome message
    console.log('%c🚀 TPoint Tech Replica', 'color: #FF6600; font-size: 20px; font-weight: bold;');
    console.log('%cWelcome to TPoint Tech Replica - Built with Core PHP MVC', 'color: #28A745; font-size: 14px;');
});

// Utility functions
const Utils = {
    // Format date
    formatDate: function(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    },
    
    // Truncate text
    truncateText: function(text, length = 100) {
        if (text.length <= length) return text;
        return text.substring(0, length) + '...';
    },
    
    // Show notification
    showNotification: function(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `flash-message ${type}`;
        notification.textContent = message;
        
        document.body.insertBefore(notification, document.body.firstChild);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    },
    
    // AJAX helper
    ajax: function(url, options = {}) {
        const defaults = {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        };
        
        const config = Object.assign(defaults, options);
        
        return fetch(url, config)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .catch(error => {
                console.error('AJAX Error:', error);
                Utils.showNotification('An error occurred. Please try again.', 'error');
                throw error;
            });
    }
};

// Make Utils available globally
window.Utils = Utils;
