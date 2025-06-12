<section id="hero" class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">
                <span class="hero-greeting">Cześć, jestem</span>
                <span class="hero-name">{{ $title ?? config('app.name') }}</span>
            </h1>
            <p class="hero-description">
                {{ $description ?? 'Fullstack Developer z pasją do tworzenia nowoczesnych aplikacji webowych. Specjalizuję się w Laravel, Vue.js i nowoczesnych technologiach frontendowych.' }}
            </p>
            <div class="hero-actions">
                <a href="{{ $primaryButtonUrl ?? '#portfolio' }}" class="btn btn-primary">
                    {{ $primaryButtonText ?? 'Zobacz projekty' }}
                </a>
                <a href="{{ $secondaryButtonUrl ?? '#kontakt' }}" class="btn btn-secondary">
                    {{ $secondaryButtonText ?? 'Skontaktuj się' }}
                </a>
            </div>
        </div>
    </div>
</section>