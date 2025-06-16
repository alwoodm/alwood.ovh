import './bootstrap';
import './project-modal';

// Obsługa mobilnego menu hamburgerowego i scrollspy
document.addEventListener('DOMContentLoaded', () => {
    const hamburgerBtn = document.querySelector('.hamburger-menu');
    const mobileNav = document.querySelector('.mobile-nav');
    const desktopNav = document.querySelector('.desktop-nav');
    const body = document.querySelector('body');
    
    // Obsługa menu hamburgerowego
    if (hamburgerBtn && mobileNav) {
        // Obsługa kliknięcia w przycisk hamburger
        hamburgerBtn.addEventListener('click', () => {
            hamburgerBtn.classList.toggle('active');
            mobileNav.classList.toggle('active');
            body.classList.toggle('menu-open');
        });
        
        // Zamknięcie menu po kliknięciu w link nawigacyjny
        const mobileNavLinks = mobileNav.querySelectorAll('.nav-link');
        mobileNavLinks.forEach(link => {
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
    
    // Funkcja scrollspy do aktywowania linków w nawigacji
    const sections = document.querySelectorAll('section');
    const allNavLinks = document.querySelectorAll('.nav-link');
    
    // Pobierz wszystkie sekcje z ich pozycjami
    const sectionPositions = Array.from(sections).map(section => {
        return {
            id: section.getAttribute('id'),
            top: section.offsetTop - 100,
            bottom: section.offsetTop + section.offsetHeight - 100
        };
    });
    
    // Płynne przewijanie strony po kliknięciu w link
    allNavLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Nie prevenimy domyślnej akcji dla linków, które nie są anchorami
            if (!this.getAttribute('href').startsWith('#')) {
                return;
            }
            
            e.preventDefault();
            const targetId = this.getAttribute('href');
            
            // Jeśli link kieruje do strony głównej, przewijamy na górę strony
            if (targetId === '/') {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
                return;
            }
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const yOffset = -70; // Offset dla nagłówka
                const y = targetElement.getBoundingClientRect().top + window.pageYOffset + yOffset;
                
                window.scrollTo({
                    top: y,
                    behavior: 'smooth'
                });
                
                // Aktualizuj aktywny link ręcznie po przewinięciu
                setTimeout(() => {
                    const sectionId = targetId.replace('#', '');
                    updateActiveNavLinks(sectionId);
                }, 100);
            }
        });
    });

    // Dodaj też obsługę dla innych linków z klasą scroll-to-section
    document.querySelectorAll('.scroll-to-section').forEach(link => {
        link.addEventListener('click', function(e) {
            if (!this.getAttribute('href').startsWith('#')) {
                return;
            }
            
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                const yOffset = -70; // Offset dla nagłówka
                const y = targetElement.getBoundingClientRect().top + window.pageYOffset + yOffset;
                
                window.scrollTo({
                    top: y,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Funkcja aktualizująca aktywne linki w obu menu
    function updateActiveNavLinks(sectionId) {
        // Usuń klasę active ze wszystkich linków
        allNavLinks.forEach(link => {
            link.classList.remove('active');
            
            // Dodaj klasę active do odpowiednich linków
            if (link.getAttribute('data-section') === sectionId) {
                link.classList.add('active');
            }
        });
    }
    
    // Funkcja do aktualizacji aktywnego linku podczas przewijania
    function updateActiveLink() {
        // Sprawdź czy jesteśmy na górze strony
        if (window.scrollY < 100) {
            updateActiveNavLinks('hero');
            return;
        }
        
        // Sprawdź czy jesteśmy na dole strony
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 150) {
            updateActiveNavLinks('kontakt');
            return;
        }
        
        // Pozycja środka ekranu
        const viewportMiddle = window.scrollY + (window.innerHeight / 2);
        
        // Sprawdź wszystkie sekcje i znajdź tę, która jest aktualnie widoczna
        for (const section of sectionPositions) {
            if (viewportMiddle >= section.top && viewportMiddle <= section.bottom) {
                updateActiveNavLinks(section.id);
                return;
            }
        }
    }
    
    // Nasłuchuj zdarzenia przewijania strony
    window.addEventListener('scroll', updateActiveLink);
    
    // Wywołaj przy ładowaniu strony
    setTimeout(updateActiveLink, 200);

    // Obsługa przycisku "Zobacz więcej projektów"
    const loadMoreBtn = document.getElementById('load-more-projects');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', async () => {
            const btnText = loadMoreBtn.querySelector('.btn-text');
            const btnLoader = loadMoreBtn.querySelector('.btn-loader');
            const btnArrow = loadMoreBtn.querySelector('.btn-arrow');
            
            // Pokaż loader i ukryj tekst
            btnText.style.display = 'none';
            btnArrow.style.display = 'none';
            btnLoader.style.display = 'flex';
            loadMoreBtn.disabled = true;
            
            try {
                const response = await fetch('/api/projects/load-more');
                const data = await response.json();
                
                if (data.html) {
                    // Dodaj nowe projekty do kontenera
                    const additionalProjects = document.getElementById('additional-projects');
                    additionalProjects.innerHTML = data.html;
                    
                    // Dodaj eventy do nowo załadowanych projektów
                    if (typeof window.attachProjectEvents === 'function') {
                        window.attachProjectEvents();
                    }
                    
                    // Ukryj przycisk po załadowaniu
                    loadMoreBtn.parentElement.style.display = 'none';
                }
            } catch (error) {
                console.error('Błąd podczas ładowania projektów:', error);
                // Przywróć przycisk w przypadku błędu
                btnText.style.display = 'block';
                btnArrow.style.display = 'block';
                btnLoader.style.display = 'none';
                loadMoreBtn.disabled = false;
            }
        });
    }
});
