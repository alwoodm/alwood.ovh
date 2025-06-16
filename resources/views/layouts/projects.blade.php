<section id="projects" class="projects-section">
    <div class="container">
        @include('components.projects.section', [
            'title' => 'Moje projekty',
            'subtitle' => 'Oto kolekcja moich najciekawszych realizacji - od projektów osobistych po komercyjne wdrożenia',
            'projects' => $featuredProjects,
            'showMoreLink' => true
        ])
    </div>
</section>
