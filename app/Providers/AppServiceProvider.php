<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Rejestruj obserwatorów
        \App\Models\SeoSettings::observe(\App\Observers\SeoSettingsObserver::class);
        
        // Wczytaj ustawienia z bazy danych, jeśli tabela istnieje
        try {
            if (\Schema::hasTable('settings')) {
                // Pobiera wszystkie ustawienia i dodaje je do konfiguracji
                $settings = \App\Models\Settings::all();
                
                foreach ($settings as $setting) {
                    config(['settings.' . $setting->key => $setting->value]);
                }
                
                // Udostępnij ustawienia dla wszystkich widoków
                view()->share('settings', function ($key, $default = null) {
                    return config('settings.' . $key, $default);
                });
            }
            
            // Wczytaj ustawienia SEO, jeśli tabela istnieje
            if (\Schema::hasTable('seo_settings')) {
                $seoService = app(\App\Services\SeoService::class);
                
                // Udostępnij serwis SEO do wszystkich widoków
                view()->share('seoService', $seoService);
                
                // Dodaj globalne funkcje pomocnicze dla widoków
                \Blade::directive('seoTitle', function ($expression) {
                    return "<?php echo app(\App\Services\SeoService::class)->generateTitle($expression); ?>";
                });
            }
        } catch (\Exception $e) {
            // Ignoruj błędy, np. gdy tabela jeszcze nie istnieje podczas migracji
            report($e);
        }
    }
}
