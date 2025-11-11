import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function (){
    window.addEventListener('scroll', () => {
        const navbar = document.getElementById('navbar');
        const navLinks = document.querySelectorAll('.nav-link');
        const mobileIcon = document.getElementById('mobile-menu-icon');
        
        if (window.scrollY > 50) {
            navbar.classList.add('bg-white/95', 'backdrop-blur-sm', 'shadow-sm', 'scrolled');
            navbar.classList.remove('bg-transparent');
            mobileIcon.classList.add('text-gray-800'); 
            mobileIcon.classList.remove('text-white');
        } else {
            navbar.classList.remove('bg-white/95', 'backdrop-blur-sm', 'shadow-sm', 'scrolled');
            navbar.classList.add('bg-transparent');
            mobileIcon.classList.remove('text-gray-800');
            mobileIcon.classList.add('text-white'); 
        }
    });

    document.getElementById('mobile-menu-btn').addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.add('hidden');
        });
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', e => {
            if (anchor.getAttribute('href').length > 1) { 
                e.preventDefault();
                const target = document.querySelector(anchor.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

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

    const navbar = document.getElementById('navbar');
    const mobileIcon = document.getElementById('mobile-menu-icon');
    
    if (navbar && mobileIcon) { 
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-white/95', 'backdrop-blur-sm', 'shadow-sm', 'scrolled');
                navbar.classList.remove('bg-transparent');
                mobileIcon.classList.add('text-gray-800'); 
                mobileIcon.classList.remove('text-white');
            } else {
                navbar.classList.remove('bg-white/95', 'backdrop-blur-sm', 'shadow-sm', 'scrolled');
                navbar.classList.add('bg-transparent');
                mobileIcon.classList.remove('text-gray-800');
                mobileIcon.classList.add('text-white'); 
            }
        });
    }

    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn && mobileMenu) { 
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    const mobileMenuLinks = document.querySelectorAll('#mobile-menu a');
    if (mobileMenuLinks && mobileMenu) { 
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    }

    const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');
    if (smoothScrollLinks) {
        smoothScrollLinks.forEach(anchor => {
            anchor.addEventListener('click', e => {
                if (anchor.getAttribute('href').length > 1) { 
                    e.preventDefault();
                    const target = document.querySelector(anchor.getAttribute('href'));
                    if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    }
});
