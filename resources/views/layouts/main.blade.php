<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Portfolio osobiste - projekty, umiejętności i kontakt">

        <title>@yield('title', config('app.name'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=jetbrains-mono:400,500,600,700|inter:400,500,600" rel="stylesheet" />

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
                position: sticky;
                top: 0;
                z-index: 100;
                backdrop-filter: blur(10px);
            }
            
            .header-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .logo {
                font-family: var(--font-mono);
                font-weight: var(--font-semibold);
                font-size: var(--text-xl);
                color: var(--text-primary);
                text-decoration: none;
            }
            
            .nav {
                display: flex;
                gap: var(--space-6);
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
            
            /* Sekcja kontaktowa */
            .contact-section {
                background-color: var(--bg-secondary);
                padding: var(--space-12) 0;
                border-top: 1px solid var(--border-primary);
            }
            
            .contact-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: var(--space-8);
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
            }
            
            .contact-link {
                display: flex;
                align-items: center;
                gap: var(--space-2);
                color: var(--primary-green);
                text-decoration: none;
                margin-bottom: var(--space-3);
                font-family: var(--font-mono);
            }
            
            .contact-form {
                background-color: var(--bg-tertiary);
                border-radius: var(--radius-md);
                padding: var(--space-6);
                border: 1px solid var(--border-primary);
                transition: border-color var(--transition-normal);
            }
            
            .contact-form:hover {
                border-color: var(--border-accent);
            }
            
            .form-group {
                margin-bottom: var(--space-4);
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
            
            @media (max-width: 768px) {
                .contact-grid {
                    grid-template-columns: 1fr;
                }
                
                .footer-content {
                    flex-direction: column;
                    text-align: center;
                }
                
                .nav {
                    gap: var(--space-3);
                }
            }
        </style>
    </head>
    <body>
        <header class="header">
            <div class="container header-content">
                <a href="/" class="logo" style="font-family: var(--font-mono); font-weight: var(--font-bold); text-decoration: none; color: var(--text-primary); font-size: var(--text-2xl);">{{ config('app.name') }}</a>
                <nav class="nav">
                    <a href="#kontakt" class="nav-link {{ request()->is('/') && !request()->is('admin*') ? 'active' : '' }}">Kontakt</a>
                    @auth
                        <a href="{{ url('/admin') }}" class="nav-link {{ request()->is('admin*') ? 'active' : '' }}">Admin</a>
                    @endauth
                </nav>
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
                    <a href="#kontakt" class="footer-link">Kontakt</a>
                </div>
            </div>
        </footer>
    </body>
</html>
