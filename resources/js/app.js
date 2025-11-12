import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function() {

    // --- Navbar scroll effect ---
    const navbar = document.getElementById('navbar');
    const mobileMenuBtn = document.getElementById('mobile-menu-btn'); 
    
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-white/98', 'backdrop-blur-md', 'shadow-lg', 'scrolled');
                navbar.classList.remove('bg-transparent');
                if (mobileMenuBtn) mobileMenuBtn.classList.add('text-gray-800'); 
            } else {
                navbar.classList.remove('bg-white/98', 'backdrop-blur-md', 'shadow-lg', 'scrolled');
                navbar.classList.add('bg-transparent');
                if (mobileMenuBtn) mobileMenuBtn.classList.remove('text-gray-800'); 
            }
        });
    }

    // --- Mobile menu toggle ---
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // --- Close mobile menu when clicking on a link ---
    const mobileMenuLinks = document.querySelectorAll('#mobile-menu a');
    if (mobileMenuLinks && mobileMenu) {
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        });
    }

    // --- Smooth scrolling for anchor links ---
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href.length > 1) { 
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // --- Lightbox functionality ---
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    
    window.openLightbox = function(src) {
        if (lightbox && lightboxImg) {
            lightboxImg.src = src;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    window.closeLightbox = function() {
        if (lightbox) {
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }

    // --- Close lightbox on ESC key ---
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });

    // --- Intersection Observer for animations ---
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // --- Observe elements for scroll animations ---
    document.querySelectorAll('.product-card, .gallery-item, .animate-fade-in-up').forEach(el => {
        if(el) { 
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        }
    });

    // --- Card Click/Flip (IMPROVED VERSION) ---
    window.toggleCard = function(card) {
        // Simply toggle the 'active' class on the clicked card
        // No auto-closing of other cards
        // No backdrop or hover interference
        card.classList.toggle('active');
        
        // Stop event propagation to prevent interference with other elements
        event.stopPropagation();
    }

});