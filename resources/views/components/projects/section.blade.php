<div class="projects-title-container">
    <h2 class="section-title">{{ $title ?? 'Projekty' }}</h2>
    @if($subtitle)
        <p class="section-subtitle">{{ $subtitle }}</p>
    @endif
</div>

<div class="projects-container">
    @forelse($projects as $project)
        @include('components.projects.card', ['project' => $project])
    @empty
        <div class="no-projects">
            <p>Brak projektów do wyświetlenia.</p>
        </div>
    @endforelse
    
    <!-- Kontener na dodatkowe projekty ładowane dynamicznie -->
    <div id="additional-projects" style="display: contents;"></div>
</div>

@if(isset($showMoreLink) && $showMoreLink && count($projects) > 0)
    <div class="projects-navigation">
        <button id="load-more-projects" class="btn btn-secondary">
            <span class="btn-text">Zobacz więcej projektów</span>
            <div class="btn-loader" style="display: none;">
                <svg class="animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="16" height="16">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Ładowanie...</span>
            </div>
            <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="16" height="16">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
            </svg>
        </button>
    </div>
@endif

@include('components.projects.modal')
