@extends('layouts.main')

@section('content')
<section class="projects-section projects-page">
    <div class="container">
        <div class="projects-title-container">
            <h1 class="section-title">{{ $title }}</h1>
            @if(isset($subtitle))
                <p class="section-subtitle">{{ $subtitle }}</p>
            @endif
        </div>

        <!-- Wyróżnione projekty - zawsze widoczne -->
        @if($featuredProjects->count() > 0)
            <div class="featured-projects-section">
                <h2 class="subsection-title">Wyróżnione projekty</h2>
                <div class="projects-container" id="featured-projects">
                    @foreach($featuredProjects as $project)
                        @include('components.projects.card', ['project' => $project])
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Inne projekty - ładowane po kliknięciu -->
        @if($otherProjects->count() > 0)
            <div class="other-projects-section">
                <div class="projects-load-more-container">
                    <button id="load-more-projects" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="16" height="16" class="mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pokaż więcej projektów ({{ $otherProjects->count() }})
                    </button>
                </div>
                <div class="projects-container" id="other-projects" style="display: none;">
                    <!-- Projekty będą ładowane dynamicznie -->
                </div>
            </div>
        @endif

        <!-- Nawigacja powrotu -->
        <div class="projects-navigation">
            <a href="{{ url('/') }}#projects" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="16" height="16" class="mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                Powrót do strony głównej
            </a>
        </div>
    </div>
</section>

@include('components.projects.modal')
@endsection

@section('contact')
    @include('layouts.contact')
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more-projects');
    const otherProjectsContainer = document.getElementById('other-projects');
    
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            // Pokaż loader
            loadMoreBtn.innerHTML = '<span class="loader">Ładowanie...</span>';
            loadMoreBtn.disabled = true;
            
            fetch('{{ route("projects.load-more") }}')
                .then(response => response.json())
                .then(data => {
                    otherProjectsContainer.innerHTML = data.html;
                    otherProjectsContainer.style.display = 'grid';
                    loadMoreBtn.style.display = 'none';
                })
                .catch(error => {
                    console.error('Error loading more projects:', error);
                    loadMoreBtn.innerHTML = 'Błąd ładowania';
                });
        });
    }
});
</script>
@endpush

<style>
.projects-page {
    padding-top: var(--space-16);
    padding-bottom: var(--space-12);
    min-height: calc(100vh - 70px - 300px);
}

.featured-projects-section {
    margin-bottom: var(--space-12);
}

.subsection-title {
    font-size: var(--text-xl);
    font-weight: var(--font-semibold);
    color: var(--text-primary);
    margin-bottom: var(--space-6);
    text-align: center;
}

.other-projects-section {
    margin-bottom: var(--space-8);
}

.projects-load-more-container {
    display: flex;
    justify-content: center;
    margin-bottom: var(--space-6);
}

.mr-2 {
    margin-right: var(--space-2);
}

.projects-navigation {
    margin-top: var(--space-8);
    display: flex;
    justify-content: center;
}

.loader {
    display: inline-block;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loading-spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 2px solid var(--border-primary);
    border-radius: 50%;
    border-top-color: var(--primary-green);
    animation: spin 1s ease-in-out infinite;
}
</style>
