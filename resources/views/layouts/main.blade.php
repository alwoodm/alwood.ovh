<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @php
            $seo = \App\Models\SeoSettings::getInstance();
            $pageTitle = $seo->generateTitle($title ?? null);
        @endphp
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $seo->site_description }}">
        @if($seo->site_keywords)
        <meta name="keywords" content="{{ $seo->site_keywords }}">
        @endif

        <title>{{ $pageTitle }}</title>
        
        <!-- Favicon -->
        <link rel="icon" href="{{ $seo->getFaviconUrl() }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ $seo->getFaviconUrl() }}" type="image/x-icon">
        
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ $pageTitle }}">
        <meta property="og:description" content="{{ $seo->site_description }}">
        @if($seo->getOgImageUrl())
        <meta property="og:image" content="{{ $seo->getOgImageUrl() }}">
        @endif
        
        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="{{ url()->current() }}">
        <meta name="twitter:title" content="{{ $pageTitle }}">
        <meta name="twitter:description" content="{{ $seo->site_description }}">
        @if($seo->getTwitterImageUrl())
        <meta name="twitter:image" content="{{ $seo->getTwitterImageUrl() }}">
        @endif

        <!-- Google Analytics -->
        @if($seo->google_analytics_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seo->google_analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $seo->google_analytics_id }}');
        </script>
        @endif
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=jetbrains-mono:400,500,600,700|inter:400,500,600" rel="stylesheet" />
        
        <!-- Projekty CSS -->
        <link href="{{ asset('css/projects.css') }}" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        
        <style>
            :root {
                /* Primary Colors - Manjaro Green Theme */
                --primary-green: #35BF5C;
                --primary-green-dark: #2A9946;
                --primary-green-light: #4CD964;

                /* Background Colors */
                --bg-primary: #1a1a1a;
                --bg-secondary: #252525;
                --bg-tertiary: #2f2f2f;

                /* Text Colors */
                --text-primary: #e8e8e8;
                --text-secondary: #b3b3b3;
                --text-muted: #808080;

                /* Accent Colors */
                --accent-success: var(--primary-green);
                --accent-warning: #f39c12;
                --accent-error: #e74c3c;

                /* Border Colors */
                --border-primary: #404040;
                --border-accent: var(--primary-green);
                
                /* Font Stack */
                --font-mono: 'JetBrains Mono', 'Roboto Mono', 'Fira Code', monospace;
                --font-sans: 'Inter', 'Roboto', system-ui, sans-serif;
                
                /* Font Sizes */
                --text-xs: 0.75rem;
                --text-sm: 0.875rem;
                --text-base: 1rem;
                --text-lg: 1.125rem;
                --text-xl: 1.25rem;
                --text-2xl: 1.5rem;
                --text-3xl: 2rem;
                
                /* Font Weights */
                --font-normal: 400;
                --font-medium: 500;
                --font-semibold: 600;
                --font-bold: 700;
                
                /* Spacing */
                --space-1: 0.25rem;
                --space-2: 0.5rem;
                --space-3: 0.75rem;
                --space-4: 1rem;
                --space-6: 1.5rem;
                --space-8: 2rem;
                --space-12: 3rem;
                --space-16: 4rem;
                
                /* Border Radius */
                --radius-sm: 4px;
                --radius-md: 8px;
                --radius-lg: 12px;
                
                /* Transitions */
                --transition-fast: 0.15s ease;
                --transition-normal: 0.2s ease;
                --transition-slow: 0.3s ease;
                
                /* Preferred easing */
                --ease-out-cubic: cubic-bezier(0.33, 1, 0.68, 1);
                --ease-in-out-cubic: cubic-bezier(0.65, 0, 0.35, 1);
            }
            
            body {
                background-color: var(--bg-primary);
                color: var(--text-primary);
                font-family: var(--font-sans);
                margin: 0;
                padding: 0;
                line-height: 1.6;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
            
            .container {
                max-width: 1280px;
                margin: 0 auto;
                padding: 0 var(--space-4);
                width: 100%;
            }
            
            .header {
                background-color: var(--bg-primary);
                border-bottom: 1px solid var(--border-primary);
                padding: var(--space-4) 0;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                width: 100%;
                z-index: 100;
                backdrop-filter: blur(10px);
            }
            
            body {
                padding-top: 70px;
            }
            
            .header-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                position: relative;
                width: 100%;
            }
            
            .logo {
                font-family: var(--font-mono);
                font-weight: var(--font-semibold);
                font-size: var(--text-xl);
                color: var(--text-primary);
                text-decoration: none;
            }
            
            .logo a {
                color: inherit;
                text-decoration: none;
            }
            
            .nav {
                display: flex;
                gap: var(--space-6);
            }
            
            .desktop-nav {
                display: flex;
            }
            
            .hamburger-menu {
                display: none; /* Ukryj hamburger na desktopie */
            }
            
            .mobile-nav {
                display: none;
                position: fixed;
                top: 60px; /* Wysokość headera */
                right: -100%;
                width: 70%;
                height: calc(100vh - 60px);
                background-color: var(--bg-secondary);
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                padding-top: var(--space-12);
                gap: var(--space-6);
                transition: right var(--transition-normal);
                z-index: 100;
                box-shadow: -5px 0 15px rgba(0, 0, 0, 0.3);
                border-left: 1px solid var(--border-primary);
            }
            
            .mobile-nav.active {
                right: 0;
                display: flex;
            }
            
            /* Overlay do mobile menu */
            body.menu-open {
                overflow: hidden;
            }
            
            body.menu-open::after {
                content: "";
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 90;
                backdrop-filter: blur(2px);
            }
            
            .hamburger-menu {
                display: none;
                flex-direction: column;
                justify-content: space-between;
                width: 24px;
                height: 18px;
                background: transparent;
                border: none;
                cursor: pointer;
                padding: 0;
                z-index: 10;
            }
            
            .hamburger-line {
                display: block;
                width: 100%;
                height: 2px;
                background-color: var(--text-primary);
                transition: all var(--transition-normal);
            }
            
            .hamburger-menu.active .hamburger-line:nth-child(1) {
                transform: translateY(8px) rotate(45deg);
            }
            
            .hamburger-menu.active .hamburger-line:nth-child(2) {
                opacity: 0;
            }
            
            .hamburger-menu.active .hamburger-line:nth-child(3) {
                transform: translateY(-8px) rotate(-45deg);
            }
            
            .nav-link {
                color: var(--text-secondary);
                font-family: var(--font-mono);
                text-decoration: none;
                transition: color var(--transition-normal);
            }
            
            .nav-link:hover,
            .nav-link.active {
                color: var(--primary-green);
            }
            
            .main-content {
                flex-grow: 1;
            }
            
            /* Hero Section */
            .hero-section {
                background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
                padding: var(--space-16) 0 var(--space-12) 0;
                min-height: calc(100vh - 70px);
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
            }
            
            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: 
                    radial-gradient(circle at 20% 80%, rgba(53, 191, 92, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(53, 191, 92, 0.05) 0%, transparent 50%);
                pointer-events: none;
            }
            
            .hero-content {
                position: relative;
                z-index: 1;
                max-width: 800px;
                text-align: center;
                margin: 0 auto;
                width: 100%;
            }
            
            .hero-title {
                font-family: var(--font-mono);
                font-size: clamp(var(--text-2xl), 5vw, 3.5rem);
                font-weight: var(--font-bold);
                color: var(--text-primary);
                margin-bottom: var(--space-6);
                line-height: 1.2;
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                gap: var(--space-2);
                text-align: center;
            }
            
            .hero-greeting {
                margin-right: var(--space-2);
            }
            
            .hero-name {
                color: var(--primary-green);
                display: inline-block;
                position: relative;
            }
            
            .hero-name::after {
                content: '';
                position: absolute;
                bottom: -4px;
                left: 0;
                right: 0;
                height: 2px;
                background: linear-gradient(90deg, var(--primary-green), var(--primary-green-light));
                border-radius: 1px;
                animation: slideIn 0.8s ease-out 0.5s both;
            }
            
            @keyframes slideIn {
                from {
                    transform: scaleX(0);
                    transform-origin: left;
                }
                to {
                    transform: scaleX(1);
                    transform-origin: left;
                }
            }
            
            .hero-description {
                font-size: var(--text-lg);
                color: var(--text-secondary);
                margin-bottom: var(--space-8);
                line-height: 1.6;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
                opacity: 0;
                animation: fadeInUp 0.8s ease-out 0.3s both;
            }
            
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .hero-actions {
                display: flex;
                gap: var(--space-4);
                justify-content: center;
                flex-wrap: wrap;
                opacity: 0;
                animation: fadeInUp 0.8s ease-out 0.6s both;
            }
            
            .hero-actions .btn {
                min-width: 160px;
                padding: var(--space-4) var(--space-6);
                font-size: var(--text-base);
                text-align: center;
                text-decoration: none;
                position: relative;
                overflow: hidden;
            }
            
            .hero-actions .btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
                transition: left 0.5s ease;
            }
            
            .hero-actions .btn:hover::before {
                left: 100%;
            }
            
            /* About Section */
            .about-section {
                padding: var(--space-12) 0;
                background-color: var(--bg-primary);
            }
            
            .about-content {
                display: grid;
                gap: var(--space-8);
                margin-top: var(--space-6);
            }
            
            .about-content.image-left {
                grid-template-columns: minmax(300px, 1fr) 2fr;
            }
            
            .about-content.image-right {
                grid-template-columns: 2fr minmax(300px, 1fr);
            }
            
            .about-content.no-image {
                grid-template-columns: 1fr;
            }
            
            .about-image {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .profile-image {
                max-width: 100%;
                border-radius: var(--radius-lg);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
                transition: transform var(--transition-normal);
            }
            
            .profile-image:hover {
                transform: translateY(-5px) scale(1.01);
            }
            
            .about-text {
                font-size: var(--text-base);
                color: var(--text-secondary);
                line-height: 1.8;
            }
            
            .about-text p {
                margin-bottom: var(--space-4);
            }
            
            .section-title {
                font-family: var(--font-mono);
                font-size: var(--text-2xl);
                color: var(--text-primary);
                margin-bottom: var(--space-8);
                position: relative;
                display: inline-block;
                text-align: center;
            }
            
            .about-title-container {
                width: 100%;
                text-align: center;
                margin-bottom: var(--space-6);
                display: flex;
                justify-content: center;
            }
            
            .section-title::after {
                content: '';
                position: absolute;
                bottom: -10px;
                left: 50%;
                transform: translateX(-50%);
                width: 60px;
                height: 3px;
                background-color: var(--primary-green);
            }
            
            .about-content {
                margin-top: var(--space-4);
                display: grid;
                gap: var(--space-8);
            }
            
            .about-content.image-left {
                grid-template-columns: minmax(300px, 1fr) 2fr;
            }
            
            .about-content.image-right {
                grid-template-columns: 2fr minmax(300px, 1fr);
            }
            
            .about-content.no-image .about-text {
                max-width: 800px;
                margin: 0 auto;
            }
            
            .about-image {
                display: flex;
                align-items: flex-start;
                justify-content: center;
            }
            
            .profile-image {
                max-width: 100%;
                height: auto;
                border-radius: var(--radius-md);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
                transition: transform var(--transition-normal);
            }
            
            /* Responsywność dla sekcji o mnie */
            @media (max-width: 768px) {
                .about-content.image-left,
                .about-content.image-right {
                    grid-template-columns: 1fr;
                }
                
                .about-image {
                    margin-bottom: var(--space-4);
                    order: -1; /* Obrazek zawsze na górze na mobile */
                }
                
                .profile-image {
                    max-width: 80%;
                }
            }
            
            /* Portfolio Section */
            .portfolio-section {
                background-color: var(--bg-primary);
                padding: var(--space-12) 0;
                border-top: 1px solid var(--border-primary);
            }
            
            .portfolio-header {
                text-align: center;
                margin-bottom: var(--space-12);
            }
            
            .section-title {
                font-family: var(--font-mono);
                font-size: var(--text-3xl);
                font-weight: var(--font-bold);
                color: var(--text-primary);
                margin-bottom: var(--space-4);
            }
            
            .section-description {
                font-size: var(--text-lg);
                color: var(--text-secondary);
                max-width: 600px;
                margin: 0 auto;
            }
            
            .portfolio-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: var(--space-8);
                margin-top: var(--space-8);
            }
            
            .project-card {
                background-color: var(--bg-secondary);
                border: 1px solid var(--border-primary);
                border-radius: var(--radius-md);
                overflow: hidden;
                transition: all var(--transition-normal);
                position: relative;
            }
            
            .project-card:hover {
                border-color: var(--border-accent);
                transform: translateY(-4px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            }
            
            .project-image {
                height: 200px;
                background: linear-gradient(135deg, var(--bg-tertiary) 0%, var(--bg-secondary) 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                border-bottom: 1px solid var(--border-primary);
            }
            
            .project-placeholder {
                color: var(--text-muted);
                opacity: 0.5;
            }
            
            .project-content {
                padding: var(--space-6);
            }
            
            .project-title {
                font-family: var(--font-mono);
                font-size: var(--text-xl);
                font-weight: var(--font-semibold);
                color: var(--text-primary);
                margin-bottom: var(--space-3);
            }
            
            .project-description {
                color: var(--text-secondary);
                line-height: 1.6;
                margin-bottom: var(--space-4);
            }
            
            .project-tech {
                display: flex;
                flex-wrap: wrap;
                gap: var(--space-2);
            }
            
            .tech-tag {
                background-color: var(--bg-tertiary);
                color: var(--primary-green);
                font-family: var(--font-mono);
                font-size: var(--text-sm);
                padding: var(--space-1) var(--space-3);
                border-radius: var(--radius-sm);
                border: 1px solid rgba(53, 191, 92, 0.2);
            }
            .contact-section {
                background-color: var(--bg-secondary);
                padding: var(--space-12) 0;
                border-top: 1px solid var(--border-primary);
            }
            
            .contact-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: var(--space-8);
                align-items: start;
            }
            
            /* Contact info styles */
            .contact-info {
                display: flex;
                flex-direction: column;
            }
            
            .contact-info-content {
                position: sticky;
                top: 100px;
            }
            
            .contact-info h2 {
                font-family: var(--font-mono);
                font-size: var(--text-2xl);
                margin-bottom: var(--space-4);
                color: var(--text-primary);
            }
            
            .contact-info p {
                color: var(--text-secondary);
                margin-bottom: var(--space-6);
                max-width: 500px;
            }
            
            .contact-links {
                margin-top: var(--space-6);
                display: flex;
                flex-direction: column;
                gap: var(--space-3);
            }
            
            .contact-link {
                display: flex;
                align-items: center;
                gap: var(--space-2);
                color: var(--primary-green);
                text-decoration: none;
                font-family: var(--font-mono);
                transition: transform var(--transition-normal);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            
            .contact-link:hover {
                transform: translateY(-2px);
            }
            
            .contact-link svg {
                flex-shrink: 0;
            }
            
            .contact-link-text {
                overflow: hidden;
                text-overflow: ellipsis;
            }
            
            /* Contact form styles */
            .contact-form-container {
                width: 100%;
            }
            
            .contact-form {
                background-color: var(--bg-tertiary);
                border-radius: var(--radius-md);
                padding: var(--space-6);
                border: 1px solid var(--border-primary);
                transition: border-color var(--transition-normal);
                max-width: 100%;
            }
            
            .contact-form:hover {
                border-color: var(--border-accent);
            }
            
            .contact-form-elements {
                display: flex;
                flex-direction: column;
                gap: var(--space-4);
            }
            
            .form-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: var(--space-4);
            }
            
            .form-group {
                margin-bottom: 0;
            }
            
            .form-submit {
                margin-top: var(--space-2);
            }
            
            label {
                display: block;
                margin-bottom: var(--space-2);
                font-family: var(--font-mono);
                color: var(--text-secondary);
            }
            
            input, textarea {
                width: 100%;
                padding: var(--space-3);
                background-color: var(--bg-primary);
                border: 1px solid var(--border-primary);
                border-radius: var(--radius-sm);
                color: var(--text-primary);
                font-family: var(--font-sans);
                transition: border-color var(--transition-normal);
            }
            
            input:focus, textarea:focus {
                outline: none;
                border-color: var(--primary-green);
                box-shadow: 0 0 0 2px rgba(53, 191, 92, 0.2);
            }
            
            textarea {
                min-height: 120px;
                resize: vertical;
            }
            
            .btn {
                background: var(--primary-green);
                color: var(--bg-primary);
                border: none;
                padding: var(--space-3) var(--space-6);
                border-radius: var(--radius-sm);
                font-family: var(--font-mono);
                font-weight: var(--font-medium);
                transition: all var(--transition-normal);
                cursor: pointer;
                display: inline-block;
                text-decoration: none;
            }
            
            .btn:hover {
                background: var(--primary-green-dark);
                transform: translateY(-1px);
            }
            
            .btn-secondary {
                background: transparent;
                color: var(--primary-green);
                border: 1px solid var(--primary-green);
            }
            
            .btn-secondary:hover {
                background: rgba(53, 191, 92, 0.1);
                transform: translateY(-1px);
            }
            
            .error-message {
                color: var(--accent-error);
                font-size: var(--text-xs);
                margin-top: var(--space-1);
            }
            
            .alert {
                padding: var(--space-3);
                border-radius: var(--radius-sm);
                margin-bottom: var(--space-4);
            }
            
            .alert-success {
                background-color: rgba(53, 191, 92, 0.1);
                border: 1px solid var(--accent-success);
                color: var(--accent-success);
            }
            
            /* Footer */
            .footer {
                background-color: var(--bg-tertiary);
                padding: var(--space-8) 0;
                border-top: 1px solid var(--border-primary);
            }
            
            .footer-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: var(--space-4);
            }
            
            .footer-copyright {
                color: var(--text-secondary);
                font-size: var(--text-sm);
            }
            
            .footer-links {
                display: flex;
                gap: var(--space-4);
            }
            
            .footer-link {
                color: var(--text-secondary);
                text-decoration: none;
                font-size: var(--text-sm);
                transition: color var(--transition-normal);
            }
            
            .footer-link:hover {
                color: var(--primary-green);
            }
            
            /* Code Block */
            .code-block {
                background: var(--bg-tertiary);
                border: 1px solid var(--border-primary);
                border-left: 4px solid var(--primary-green);
                padding: var(--space-4);
                border-radius: var(--radius-sm);
                font-family: var(--font-mono);
                color: var(--text-primary);
                overflow-x: auto;
                margin: var(--space-4) 0;
            }
            
            /* Card Component */
            .card {
                background: var(--bg-secondary);
                border: 1px solid var(--border-primary);
                border-radius: var(--radius-md);
                padding: var(--space-6);
                transition: border-color var(--transition-normal);
            }
            
            .card:hover {
                border-color: var(--border-accent);
            }
            
            /* Hamburger Menu */
            .hamburger-menu {
                display: none;
                flex-direction: column;
                justify-content: space-between;
                width: 30px;
                height: 24px;
                background: transparent;
                border: none;
                cursor: pointer;
                padding: 0;
                z-index: 200;
            }
            
            .hamburger-line {
                width: 100%;
                height: 2px;
                background-color: var(--text-primary);
                transition: all var(--transition-normal);
            }
            
            /* Responsywność - breakpoints */
            @media (max-width: 1024px) {
                .hero-section {
                    padding: var(--space-12) 0 var(--space-8) 0;
                    min-height: calc(100vh - 70px);
                }
                
                .hero-title {
                    font-size: clamp(var(--text-xl), 4vw, 2.5rem);
                    flex-direction: column;
                    align-items: center;
                    gap: var(--space-1);
                    text-align: center;
                    justify-content: center;
                    width: 100%;
                }
                
                .hero-name {
                    font-size: clamp(var(--text-2xl), 5vw, 3rem);
                    margin-top: var(--space-2);
                }
                
                .hero-description {
                    font-size: var(--text-base);
                }
                
                .contact-grid {
                    grid-template-columns: 1fr 1fr;
                    gap: var(--space-6);
                }
                
                .contact-info-content {
                    position: static;
                }
            }
            
            @media (max-width: 768px) {
                body {
                    padding-top: 60px;
                }
                
                .header {
                    padding: var(--space-3) 0;
                }
                
                /* Ukryj desktop nav i pokaż hamburger menu */
                .desktop-nav {
                    display: none;
                }
                
                .hamburger-menu {
                    display: flex;
                }
                
                .hero-section {
                    padding: var(--space-8) 0 var(--space-6) 0;
                    min-height: calc(100vh - 60px);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                
                .hero-content {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    width: 100%;
                }
                
                .hero-title {
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                    gap: var(--space-2);
                }
                
                .hero-greeting {
                    margin-right: 0;
                    font-size: var(--text-lg);
                }
                
                .hero-name {
                    font-size: clamp(var(--text-2xl), 7vw, 3rem);
                    margin-top: var(--space-1);
                }
                
                .hero-actions {
                    flex-direction: column;
                    align-items: center;
                    margin-top: var(--space-8);
                }
                
                .hero-actions .btn {
                    width: 100%;
                    max-width: 280px;
                    margin-bottom: var(--space-3);
                }
                
                /* About section responsive */
                .about-content.image-left,
                .about-content.image-right {
                    grid-template-columns: 1fr;
                }
                
                .about-image {
                    margin-bottom: var(--space-6);
                    order: -1; /* Zawsze na górze na mobilnych */
                    width: 100%;
                    display: flex;
                    justify-content: center;
                }
                
                .profile-image {
                    max-width: 80%;
                }
                
                /* Centrowanie tytułu sekcji na urządzeniach mobilnych */
                .section-title {
                    display: block;
                    text-align: center;
                    margin-left: auto;
                    margin-right: auto;
                }
                
                .section-title::after {
                    left: 50%;
                    transform: translateX(-50%);
                }
                
                /* Animacja hamburger menu przy aktywacji */
                .hamburger-menu.active .hamburger-line:nth-child(1) {
                    transform: translateY(8px) rotate(45deg);
                }
                
                .hamburger-menu.active .hamburger-line:nth-child(2) {
                    opacity: 0;
                }
                
                .hamburger-menu.active .hamburger-line:nth-child(3) {
                    transform: translateY(-8px) rotate(-45deg);
                }
                
                /* Menu overlay */
                body.menu-open {
                    overflow: hidden;
                }
                
                body.menu-open::after {
                    content: "";
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.5);
                    z-index: 90;
                    backdrop-filter: blur(2px);
                }
                
                /* Nawigacja mobilna */
                .desktop-nav {
                    display: flex;
                }
                
                .mobile-nav {
                    display: none;
                    position: fixed;
                    top: 70px; /* Wysokość headera */
                    right: -100%;
                    width: 70%;
                    height: calc(100vh - 70px);
                    background-color: var(--bg-secondary);
                    flex-direction: column;
                    align-items: center;
                    justify-content: flex-start;
                    padding-top: var(--space-12);
                    gap: var(--space-6);
                    transition: right var(--transition-normal);
                    z-index: 100;
                    box-shadow: -5px 0 15px rgba(0, 0, 0, 0.3);
                    border-left: 1px solid var(--border-primary);
                }
                
                .mobile-nav.active {
                    right: 0;
                    display: flex;
                }
                
                .nav-link {
                    font-size: var(--text-lg);
                }
                
                /* Układy responsywne */
                .contact-grid {
                    grid-template-columns: 1fr;
                }
                
                .footer-content {
                    flex-direction: column;
                    text-align: center;
                }
            }
            
            @media (max-width: 576px) {
                .hero-section {
                    padding: var(--space-12) 0 var(--space-8);
                    min-height: calc(100vh - 60px);
                }
                
                .hero-title {
                    margin-bottom: var(--space-4);
                    width: 100%;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    gap: var(--space-3);
                }
                
                .hero-greeting {
                    font-size: var(--text-lg);
                }
                
                .hero-name {
                    font-size: clamp(var(--text-2xl), 7vw, 3rem);
                    margin-top: var(--space-2);
                }
                
                .hero-description {
                    margin-bottom: var(--space-6);
                    font-size: var(--text-base);
                    text-align: center;
                    padding: 0 var(--space-2);
                }
                
                .container {
                    padding: 0 var(--space-3);
                }
                
                .contact-section {
                    padding: var(--space-8) 0;
                }
                
                .contact-form {
                    padding: var(--space-4);
                }
                
                .form-group {
                    margin-bottom: var(--space-3);
                }
                
                .btn {
                    width: 100%;
                    text-align: center;
                }
                
                .contact-info h2 {
                    font-size: var(--text-xl);
                }
            }
            
            @media (max-width: 480px) {
                .hero-content {
                    padding: 0 var(--space-2);
                }
                
                .hero-title {
                    flex-direction: column;
                    align-items: center;
                }
                
                .hero-greeting {
                    font-size: 1.2rem;
                    margin-bottom: var(--space-2);
                    text-align: center;
                }
                
                .hero-name {
                    font-size: 2rem;
                    text-align: center;
                    display: block;
                    width: 100%;
                }
                
                .hero-name::after {
                    width: 100%;
                }
                
                .hero-description {
                    font-size: 1rem;
                    margin-top: var(--space-4);
                    line-height: 1.6;
                    max-width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <header class="header">
            <div class="container">
                @include('components.header.nav')
            </div>
        </header>

        <main class="main-content">
            @yield('content')
        </main>

        @yield('contact')

        <footer class="footer">
            <div class="container footer-content">
                <div class="footer-copyright">
                    &copy; {{ date('Y') }} {{ config('settings.made_by_text', 'Made by') }}
                </div>
                <div class="footer-links">
                    <a href="/" class="footer-link">Strona główna</a>
                    <a href="#projects" class="footer-link">Projekty</a>
                    <a href="#kontakt" class="footer-link">Kontakt</a>
                </div>
            </div>
        </footer>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/project-modal.js'])
    @stack('scripts')
    </body>
</html>
