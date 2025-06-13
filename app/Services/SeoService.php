<?php

namespace App\Services;

use App\Models\SeoSettings;
use Illuminate\Support\Facades\Cache;

class SeoService
{
    /**
     * Pobiera ustawienia SEO z cache lub z bazy danych
     *
     * @return SeoSettings
     */
    public function getSettings(): SeoSettings
    {
        return Cache::remember('seo_settings', 3600, function () {
            return SeoSettings::getInstance();
        });
    }
    
    /**
     * Generuje pełny tytuł strony na podstawie podanego tytułu podstrony
     *
     * @param string|null $pageTitle Tytuł podstrony
     * @return string
     */
    public function generateTitle(?string $pageTitle = null): string
    {
        return $this->getSettings()->generateTitle($pageTitle);
    }
    
    /**
     * Czyści cache ustawień SEO
     *
     * @return void
     */
    public function clearCache(): void
    {
        Cache::forget('seo_settings');
    }
}
