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
</div>

@if(isset($showMoreLink) && $showMoreLink && count($projects) > 0)
    <div class="projects-navigation">
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">
            Zobacz wszystkie projekty
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="16" height="16" class="ml-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
            </svg>
        </a>
    </div>
@endif

@include('components.projects.modal')
