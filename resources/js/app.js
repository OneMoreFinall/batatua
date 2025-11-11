import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function() {

    // --- Navbar scroll effect ---
    const navbar = document.getElementById('navbar');
    const mobileMenuBtn = document.getElementById('mobile-menu-btn'); // Ambil tombol mobile
    
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-white/98', 'backdrop-blur-md', 'shadow-lg', 'scrolled');
                navbar.classList.remove('bg-transparent');
                if (mobileMenuBtn) mobileMenuBtn.classList.add('text-gray-800'); // Ganti warna ikon
            } else {
                navbar.classList.remove('bg-white/98', 'backdrop-blur-md', 'shadow-lg', 'scrolled');
                navbar.classList.add('bg-transparent');
                if (mobileMenuBtn) mobileMenuBtn.classList.remove('text-gray-800'); // Kembalikan warna ikon
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
            if (href.length > 1) { // Pastikan bukan cuma '#'
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
        if(el) { // Cek jika elemen ada
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        }
    });

    // --- Card Click (dari file app.js lama Anda) ---
    window.toggleCard = function(card) {
        document.querySelectorAll('.group.active').forEach(c => {
            if (c !== card) c.classList.remove('active');
        });
        card.classList.toggle('active');
        
        const anyActive = document.querySelector('.group.active');
        if (anyActive) {
            document.body.classList.add('backdrop-blur-sm');
        } else {
            document.body.classList.remove('backdrop-blur-sm');
        }
    }

});