@extends('layouts.main')

@php
    // Ustaw tytuł strony (będzie użyty w meta tagach SEO)
    $title = $project->title;
@endphp

@section('content')
    <section class="project-details-section">
        <div class="container">
            <div class="project-header">
                <h1 class="project-title">{{ $project->title }}</h1>
                <p class="project-short-description">{{ $project->short_description }}</p>
            </div>
            
            @if($project->show_thumbnail && $project->thumbnail_path)
                <div class="project-hero-image">
                    <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}">
                </div>
            @endif
            
            <div class="project-content">
                <div class="project-description">
                    {!! $project->description_html !!}
                </div>
                
                <div class="project-sidebar">
                    @if($project->technologies && count($project->technologies) > 0)
                        <div class="project-technologies sidebar-section">
                            <h3>Technologie</h3>
                            <div class="technologies-list">
                                @foreach($project->technologies as $tech)
                                    <span class="tech-badge">{{ $tech }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <div class="project-links sidebar-section">
                        <h3>Linki</h3>
                        <div class="links-list">
                            @if($project->github_url)
                                <a href="https://{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="link-item github">
                                    <i class="icon-github"></i>
                                    <span>Kod źródłowy</span>
                                </a>
                            @endif
                            
                            @if($project->demo_url)
                                <a href="https://{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="link-item demo">
                                    <i class="icon-external-link"></i>
                                    <span>Wersja Demo</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="back-to-projects">
                <a href="{{ route('home') }}#projects" class="btn-secondary">
                    <i class="icon-arrow-left"></i>
                    <span>Wróć do projektów</span>
                </a>
            </div>
        </div>
    </section>
@endsection
