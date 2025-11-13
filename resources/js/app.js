import './bootstrap';
import './contact';
import './home';
import './menu';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function() {

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

    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    const mobileMenuLinks = document.querySelectorAll('#mobile-menu a');
    if (mobileMenuLinks && mobileMenu) {
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        });
    }

    document.querySelectorAll('a[href*="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const url = new URL(this.href);
            const currentUrl = new URL(window.location.href);

            if (url.pathname === currentUrl.pathname && url.search === currentUrl.search && url.hash) {
                e.preventDefault();
                const target = document.querySelector(url.hash);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    if (window.location.hash) {
        setTimeout(() => {
            const target = document.querySelector(window.location.hash);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }, 100);
    }

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

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });

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

    document.querySelectorAll('.product-card, .gallery-item, .animate-fade-in-up').forEach(el => {
        if(el) { 
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        }
    });

    window.toggleCard = function(card) {
        card.classList.toggle('active');
        
        event.stopPropagation();
    }

});