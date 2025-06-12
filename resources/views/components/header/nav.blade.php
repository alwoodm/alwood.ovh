<div class="header-content">
    <div class="logo">
        <a href="/">{{ config('app.name') }}</a>
    </div>
    <nav class="nav">
        <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Strona główna</a>
        <a href="#o-mnie" class="nav-link">O mnie</a>
        <a href="#kontakt" class="nav-link">Kontakt</a>
    </nav>
    <div class="hamburger-menu">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
    </div>
</div>
