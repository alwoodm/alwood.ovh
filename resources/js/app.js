import './bootstrap';

// Obsługa mobilnego menu hamburgerowego
document.addEventListener('DOMContentLoaded', () => {
    const hamburgerBtn = document.querySelector('.hamburger-menu');
    const mobileNav = document.getElementById('mobile-nav');
    const body = document.querySelector('body');
    
    if (hamburgerBtn && mobileNav) {
        // Obsługa kliknięcia w przycisk hamburger
        hamburgerBtn.addEventListener('click', () => {
            hamburgerBtn.classList.toggle('active');
            mobileNav.classList.toggle('active');
            body.classList.toggle('menu-open');
        });
        
        // Zamknięcie menu po kliknięciu w link nawigacyjny
        const navLinks = mobileNav.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                hamburgerBtn.classList.remove('active');
                mobileNav.classList.remove('active');
                body.classList.remove('menu-open');
            });
        });
        
        // Zamknięcie menu po kliknięciu poza menu
        document.addEventListener('click', (event) => {
            if (!mobileNav.contains(event.target) && !hamburgerBtn.contains(event.target) && mobileNav.classList.contains('active')) {
                hamburgerBtn.classList.remove('active');
                mobileNav.classList.remove('active');
                body.classList.remove('menu-open');
            }
        });
    }
});
