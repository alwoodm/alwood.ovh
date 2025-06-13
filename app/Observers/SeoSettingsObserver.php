<?php

namespace App\Observers;

use App\Models\SeoSettings;
use Illuminate\Support\Facades\Cache;

class SeoSettingsObserver
{
    /**
     * Handle the SeoSettings "created" event.
     */
    public function created(SeoSettings $seoSettings): void
    {
        $this->clearCache();
    }

    /**
     * Handle the SeoSettings "updated" event.
     */
    public function updated(SeoSettings $seoSettings): void
    {
        $this->clearCache();
    }

    /**
     * Handle the SeoSettings "deleted" event.
     */
    public function deleted(SeoSettings $seoSettings): void
    {
        $this->clearCache();
    }

    /**
     * Clear the SEO settings cache.
     */
    private function clearCache(): void
    {
        Cache::forget('seo_settings');
    }
}
