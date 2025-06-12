<section id="about" class="about-section">
    <div class="container">
        @include('components.about.section', [
            'title' => $aboutSettings->section_title ?? 'O mnie',
            'content' => $aboutSettings->content ?? '<p>Sekcja o mnie...</p>',
            'showImage' => $aboutSettings->show_image ?? false,
            'imagePosition' => $aboutSettings->image_position ?? 'left',
            'imageUrl' => $aboutSettings->getImageUrl() ?? null
        ])
    </div>
</section>
