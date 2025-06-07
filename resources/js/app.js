import './bootstrap';

// Obsługa mobilnego menu hamburgerowego
document.addEventListener('DOMContentLoaded', () => {
    const hamburgerBtn = document.querySelector('.hamburger-menu');
    const mobileNav = document.getElementById('mobile-nav');
    const body = document.querySelector('body');
    
    if (hamburgerBtn && mobileNav) {
        // Funkcja zamykania menu
        const closeMenu = () => {
            hamburgerBtn.classList.remove('active');
            mobileNav.classList.remove('active');
            body.classList.remove('menu-open');
        };
        
        // Obsługa kliknięcia w przycisk hamburger
        hamburgerBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            hamburgerBtn.classList.toggle('active');
            mobileNav.classList.toggle('active');
            body.classList.toggle('menu-open');
        });
        
        // Zamknięcie menu po kliknięciu w link nawigacyjny
        const navLinks = mobileNav.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                closeMenu();
                
                // Jeśli to link wewnętrzny z kotwicą, dodajemy płynne przewijanie
                if (link.getAttribute('href').startsWith('#')) {
                    const targetId = link.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        setTimeout(() => {
                            targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }, 100);
                    }
                }
            });
        });
        
        // Zamknięcie menu po kliknięciu poza menu
        document.addEventListener('click', (event) => {
            if (!mobileNav.contains(event.target) && !hamburgerBtn.contains(event.target) && mobileNav.classList.contains('active')) {
                closeMenu();
            }
        });
        
        // Zamknięcie menu przy zmianie rozmiaru okna na większy
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768 && mobileNav.classList.contains('active')) {
                closeMenu();
            }
        });
        
        // Dodanie klasy do body gdy menu jest aktywne aby zablokować przewijanie
        document.addEventListener('scroll', () => {
            if (body.classList.contains('menu-open')) {
                window.scrollTo(0, 0);
            }
        });
    }
});
