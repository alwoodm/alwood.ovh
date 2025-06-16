/**
 * Obsługa modala projektu
 */
document.addEventListener('DOMContentLoaded', function() {
    // Referencje do elementów DOM
    const modal = document.getElementById('project-modal');
    const modalTitle = document.getElementById('modal-project-title');
    const modalDescription = document.getElementById('modal-project-description');
    const modalImage = document.getElementById('modal-project-image');
    const modalTechnologies = document.getElementById('modal-project-technologies');
    const modalGithubLink = document.getElementById('modal-github-link');
    const modalDemoLink = document.getElementById('modal-demo-link');
    const modalClose = document.querySelector('.modal-close');
    const modalOverlay = document.querySelector('.modal-overlay');
    
    // Przyciski do otwierania modala
    const projectButtons = document.querySelectorAll('.view-project-details');
    
    // Funkcja otwierająca modal i pobierająca dane projektu
    function openProjectModal(slug) {
        // Animacja ładowania
        modalTitle.innerHTML = '<div class="loading-spinner">Ładowanie...</div>';
        modalDescription.innerHTML = '';
        modalImage.innerHTML = '';
        modalTechnologies.innerHTML = '';
        modalGithubLink.innerHTML = '';
        modalDemoLink.innerHTML = '';
        
        // Otwórz modal
        modal.style.display = 'block';
        document.body.classList.add('modal-open');
        
        // Pobieranie danych projektu przez AJAX
        fetch(`/projekty/dane/${slug}`)
            .then(response => response.json())
            .then(data => {
                // Ustawienie danych w modalu
                modalTitle.textContent = data.title;
                modalDescription.innerHTML = data.description || '<p>Brak szczegółowego opisu projektu.</p>';
                
                // Obraz projektu
                if (data.thumbnailUrl) {
                    const img = new Image();
                    img.onload = function() {
                        modalImage.innerHTML = `<img src="${data.thumbnailUrl}" alt="${data.title}">`;
                        modalImage.style.display = 'block';
                    };
                    img.onerror = function() {
                        modalImage.style.display = 'none';
                    };
                    img.src = data.thumbnailUrl;
                } else {
                    modalImage.style.display = 'none';
                }
                
                // Technologie
                modalTechnologies.innerHTML = '';
                if (data.technologies && data.technologies.length > 0) {
                    data.technologies.forEach(tech => {
                        const techBadge = document.createElement('span');
                        techBadge.className = 'tech-badge';
                        techBadge.textContent = tech;
                        modalTechnologies.appendChild(techBadge);
                    });
                } else {
                    modalTechnologies.innerHTML = '<p>Brak informacji o technologiach.</p>';
                }
                
                // Link do kodu
                if (data.codeUrl) {
                    modalGithubLink.innerHTML = `
                        <a href="${data.codeUrl}" target="_blank" rel="noopener noreferrer" class="btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20" class="icon">
                                <path fill-rule="evenodd" d="M12.026 2c-5.509 0-9.974 4.465-9.974 9.974 0 4.406 2.857 8.145 6.821 9.465.499.09.679-.217.679-.481 0-.237-.008-.865-.011-1.696-2.775.602-3.361-1.338-3.361-1.338-.452-1.152-1.107-1.459-1.107-1.459-.905-.619.069-.605.069-.605 1.002.07 1.527 1.028 1.527 1.028.89 1.524 2.336 1.084 2.902.829.091-.645.351-1.085.635-1.334-2.214-.251-4.542-1.107-4.542-4.93 0-1.087.389-1.979 1.024-2.675-.101-.253-.446-1.268.099-2.64 0 0 .837-.269 2.742 1.021a9.582 9.582 0 0 1 2.496-.336 9.554 9.554 0 0 1 2.496.336c1.906-1.291 2.742-1.021 2.742-1.021.545 1.372.203 2.387.099 2.64.64.696 1.024 1.587 1.024 2.675 0 3.833-2.33 4.675-4.552 4.922.355.308.675.916.675 1.846 0 1.334-.012 2.41-.012 2.737 0 .267.178.577.687.479C19.146 20.115 22 16.379 22 11.974 22 6.465 17.535 2 12.026 2z" clip-rule="evenodd"/>
                            </svg>
                            <span>Zobacz kod</span>
                        </a>
                    `;
                } else {
                    modalGithubLink.innerHTML = '';
                }
                
                // Link do demo
                if (data.demoUrl) {
                    modalDemoLink.innerHTML = `
                        <a href="${data.demoUrl}" target="_blank" rel="noopener noreferrer" class="btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20" height="20" class="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                            </svg>
                            <span>Zobacz demo</span>
                        </a>
                    `;
                } else {
                    modalDemoLink.innerHTML = '';
                }
            })
            .catch(error => {
                console.error('Błąd podczas pobierania danych projektu:', error);
                modalTitle.textContent = 'Wystąpił błąd';
                modalDescription.innerHTML = '<p>Nie udało się pobrać danych projektu. Spróbuj ponownie później.</p>';
            });
    }
    
    // Funkcja zamykająca modal
    function closeProjectModal() {
        modal.style.display = 'none';
        document.body.classList.remove('modal-open');
    }
    
    // Funkcja do dodawania eventów do przycisków projektów
    function attachProjectEvents() {
        // Przyciski szczegółów
        document.querySelectorAll('.view-project-details:not([data-event-attached])').forEach(button => {
            button.addEventListener('click', function() {
                const slug = this.getAttribute('data-project-slug');
                if (slug) {
                    openProjectModal(slug);
                }
            });
            button.setAttribute('data-event-attached', 'true');
        });

        // Kliknięcie w kartę projektu
        document.querySelectorAll('.project-card:not([data-event-attached])').forEach(card => {
            card.addEventListener('click', function(event) {
                // Pomijamy, jeśli kliknięto w przycisk lub link (tam już jest event)
                if (!event.target.closest('.project-buttons') && !event.target.closest('a')) {
                    const slug = this.getAttribute('data-project-slug');
                    if (slug) {
                        openProjectModal(slug);
                    }
                }
            });
            card.setAttribute('data-event-attached', 'true');
        });
    }

    // Dodanie eventów do istniejących przycisków
    attachProjectEvents();

    // Wydarzenie kliknięcia w tło modala
    modalOverlay.addEventListener('click', closeProjectModal);
    
    // Wydarzenie kliknięcia w przycisk zamykania
    modalClose.addEventListener('click', closeProjectModal);
    
    // Wydarzenie naciśnięcia klawisza ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && modal.style.display === 'block') {
            closeProjectModal();
        }
    });

    // Udostępnienie funkcji globalnie
    window.attachProjectEvents = attachProjectEvents;
});
