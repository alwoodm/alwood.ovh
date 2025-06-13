<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisits
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Nie śledzimy botów i zapytań AJAX
        $shouldTrack = 
            !$request->ajax() && 
            !$this->isBot($request->userAgent()) && 
            $request->method() === 'GET' &&
            !$request->is('admin*', 'filament*', 'livewire*', '_debugbar*', 'assets*', 'build*', 'js*', 'css*', 'images*', 'fonts*', 'api*');
            
        $response = $next($request);
        
        if ($shouldTrack) {
            // Używamy unikalnej sesji zamiast tylko IP, by lepiej śledzić odwiedziny
            $sessionId = $request->session()->getId();
            
            // Dla tego samego URL-a i sesji nie zapisujemy ponownie w ciągu 30 minut
            $url = $request->path() === '/' ? 'home' : $request->path();
            $recentVisit = PageVisit::where('ip_hash', $this->hashIp($request->ip() . '_' . $sessionId))
                ->where('url', $url)
                ->where('visited_at', '>=', now()->subMinutes(30))
                ->exists();
                
            if (!$recentVisit) {
                PageVisit::create([
                    'ip_hash' => $this->hashIp($request->ip() . '_' . $sessionId),
                    'user_agent' => $request->userAgent(),
                    'url' => $url,
                    'referrer' => $request->header('referer'),
                    'visited_at' => now(),
                ]);
            }
        }
        
        return $response;
    }
    
    /**
     * Sprawdza czy user agent wygląda jak bot
     */
    protected function isBot(?string $userAgent): bool
    {
        if (empty($userAgent)) {
            return true;
        }
        
        $botKeywords = [
            'bot', 'spider', 'crawler', 'scraper', 'slurp', 'baidu', 'yandex', 'google', 'bing', 'yahoo', 'duckduckgo', 'facebook',
            'ping', 'scan', 'monitor', 'search', 'sitemap', 'check', 'indexer', 'webmaster', 'archive', 'wget', 'curl'
        ];
        
        $userAgentLower = strtolower($userAgent);
        
        foreach ($botKeywords as $keyword) {
            if (strpos($userAgentLower, $keyword) !== false) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Hashuje adres IP dla zachowania prywatności
     * Dodajemy fragment user agent aby rozróżnić różne przeglądarki
     */
    protected function hashIp(string $ip): string
    {
        // Dodanie fragmentu user agent i timestamp dnia
        // dla lepszego rozróżniania różnych wizyt z tego samego IP
        $userAgent = request()->userAgent() ?? '';
        $browserInfo = substr($userAgent, 0, 50); // Pierwsze 50 znaków ua wystarczy do identyfikacji przeglądarki
        
        // Dodajemy losowy składnik do każdej nowej sesji
        $sessionKey = session()->getId() ?? uniqid();
        
        return hash('sha256', $ip . $browserInfo . $sessionKey . config('app.key'));
    }
}
