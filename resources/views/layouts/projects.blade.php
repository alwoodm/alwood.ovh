<section id="projects" class="projects-section">
    <div class="container">
        @include('components.projects.section', [
            'title' => 'Moje projekty',
            'subtitle' => 'Zobacz moje najciekawsze realizacje i projekty',
            'projects' => $featuredProjects,
            'showMoreLink' => true
        ])
    </div>
</section>
