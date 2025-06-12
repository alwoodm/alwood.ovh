<div class="about-title-container">
    <h2 class="section-title">{{ $title ?? 'O mnie' }}</h2>
</div>

<div class="about-content {{ $showImage && $imagePosition === 'left' ? 'image-left' : ($showImage && $imagePosition === 'right' ? 'image-right' : 'no-image') }}">
    @if($showImage && $imageUrl)
    <div class="about-image">
        <img src="{{ $imageUrl }}" alt="Zdjęcie profilowe" class="profile-image">
    </div>
    @endif
    
    <div class="about-text">
        {!! $content !!}
    </div>
</div>
