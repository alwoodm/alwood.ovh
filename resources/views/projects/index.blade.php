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

        <div class="projects-container">
            @forelse($projects as $project)
                @include('components.projects.card', ['project' => $project])
            @empty
                <div class="no-projects">
                    <p>Brak projektów do wyświetlenia.</p>
                </div>
            @endforelse
        </div>
        
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

<style>
.projects-page {
    padding-top: var(--space-16);
    padding-bottom: var(--space-12);
    min-height: calc(100vh - 70px - 300px);
}

.mr-2 {
    margin-right: var(--space-2);
}

.projects-navigation {
    margin-top: var(--space-8);
    display: flex;
    justify-content: center;
}
</style>
