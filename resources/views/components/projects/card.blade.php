<div class="project-card" data-project-slug="{{ $project->slug }}">
    @if($project->show_thumbnail && $project->thumbnail_url)
        <div class="project-thumbnail">
            <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}">
            @if($project->is_featured)
                <span class="featured-badge">Wyróżniony</span>
            @endif
        </div>
    @endif
    <div class="project-card-content">
        <h3 class="project-title">{{ $project->title }}</h3>
        <p class="project-description">{{ $project->short_description }}</p>
        
        @if($project->technologies && count($project->technologies) > 0)
            <div class="project-technologies">
                @foreach($project->technologies as $tech)
                    <span class="tech-badge">{{ $tech }}</span>
                @endforeach
            </div>
        @endif
        
        <div class="project-buttons">
            <button class="btn-primary view-project-details" data-project-slug="{{ $project->slug }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="16" height="16" class="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>
                <span>Szczegóły</span>
            </button>
        </div>
    </div>
</div>
