<div class="header-content">
    <div class="logo">
        <a href="/">{{ config('app.name') }}</a>
    </div>
    
    <nav class="nav desktop-nav">
        <a href="/" class="nav-link" data-section="hero">Strona główna</a>
        <a href="#about" class="nav-link" data-section="about">O mnie</a>
        <a href="#kontakt" class="nav-link" data-section="kontakt">Kontakt</a>
        @auth
            <a href="{{ url('/admin') }}" class="nav-link {{ request()->is('admin*') ? 'active' : '' }}">Admin</a>
        @endauth
    </nav>
    
    <button class="hamburger-menu" aria-label="Menu">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
    </button>
    
    <nav class="nav mobile-nav" id="mobile-nav">
        <a href="/" class="nav-link" data-section="hero">Strona główna</a>
        <a href="#about" class="nav-link" data-section="about">O mnie</a>
        <a href="#kontakt" class="nav-link" data-section="kontakt">Kontakt</a>
        @auth
            <a href="{{ url('/admin') }}" class="nav-link {{ request()->is('admin*') ? 'active' : '' }}">Admin</a>
        @endauth
    </nav>
</div>

<style>
    @media (max-width: 768px) {
        .desktop-nav {
            display: none !important;
        }
        
        .hamburger-menu {
            display: flex !important;
        }
    }
</style>
