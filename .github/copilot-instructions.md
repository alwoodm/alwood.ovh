## Design System Guidelines

### Color Palette

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
}

### Typography System

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

### Layout Patterns

/* Container Widths */
--container-sm: 640px;
--container-md: 768px;
--container-lg: 1024px;
--container-xl: 1280px;

/* Spacing Scale */
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

### Component Design Rules

#### Buttons

.btn-primary {
background: var(--primary-green);
color: var(--bg-primary);
border: none;
padding: var(--space-3) var(--space-6);
border-radius: var(--radius-sm);
font-family: var(--font-mono);
font-weight: var(--font-medium);
transition: all 0.2s ease;
}

.btn-primary:hover {
background: var(--primary-green-dark);
transform: translateY(-1px);
}

.btn-secondary {
background: transparent;
color: var(--primary-green);
border: 1px solid var(--primary-green);
}

#### Cards

.card {
background: var(--bg-secondary);
border: 1px solid var(--border-primary);
border-radius: var(--radius-md);
padding: var(--space-6);
transition: border-color 0.2s ease;
}

.card:hover {
border-color: var(--border-accent);
}

#### Navigation

.nav {
background: var(--bg-primary);
border-bottom: 1px solid var(--border-primary);
backdrop-filter: blur(10px);
}

.nav-link {
color: var(--text-secondary);
font-family: var(--font-mono);
transition: color 0.2s ease;
}

.nav-link:hover,
.nav-link.active {
color: var(--primary-green);
}

### Design Principles

#### Minimalism
- Use whitespace generously
- Limit color usage to essential elements
- Prioritize content over decoration
- Keep typography hierarchy simple

#### Consistency
- Always use defined color variables
- Maintain consistent spacing using the scale
- Use monospace fonts for technical content
- Apply hover effects consistently across interactive elements

#### Accessibility
- Ensure minimum 4.5:1 contrast ratio
- Use semantic HTML elements
- Provide focus indicators
- Support keyboard navigation

#### Animation Guidelines

/* Standard transitions */
--transition-fast: 0.15s ease;
--transition-normal: 0.2s ease;
--transition-slow: 0.3s ease;

/* Preferred easing */
--ease-out-cubic: cubic-bezier(0.33, 1, 0.68, 1);
--ease-in-out-cubic: cubic-bezier(0.65, 0, 0.35, 1);

### Responsive Breakpoints

/* Mobile first approach */
--bp-sm: 640px;
--bp-md: 768px;
--bp-lg: 1024px;
--bp-xl: 1280px;

### Code Block Styling

.code-block {
background: var(--bg-tertiary);
border: 1px solid var(--border-primary);
border-left: 4px solid var(--primary-green);
padding: var(--space-4);
border-radius: var(--radius-sm);
font-family: var(--font-mono);
color: var(--text-primary);
overflow-x: auto;
}

### Usage Instructions
1. Always use CSS custom properties for colors and spacing
2. Prefer flexbox and grid for layouts
3. Use the monospace font for code, technical content, and navigation
4. Apply the Manjaro green (#35BF5C) sparingly as accent color
5. Maintain dark theme as primary with light text
6. Ensure all interactive elements have hover states
7. Use subtle animations with the defined timing functionsDobrze dodaj teraz 