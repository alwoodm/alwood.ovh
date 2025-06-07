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
        } catch (\Exception $e) {
            // Ignoruj błędy, np. gdy tabela jeszcze nie istnieje podczas migracji
            report($e);
        }
    }
}
