<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageVisit extends Model
{
    // 1. Użycie traitów
    use HasFactory;
    
    // 2. Właściwości (properties)
    protected $fillable = [
        'ip_hash',
        'user_agent',
        'url',
        'visited_at',
        'referrer',
    ];
    
    protected $casts = [
        'visited_at' => 'datetime',
    ];
    
    // 5. Metody pomocnicze - alfabetycznie
    public static function countTotalVisits(): int
    {
        return static::count();
    }
    
    public static function countTodayVisits(): int
    {
        // Używamy strftime dla SQLite zamiast whereDate
        return static::whereRaw("strftime('%Y-%m-%d', visited_at) = ?", [now()->toDateString()])->count();
    }
    
    public static function countUniqueVisits(): int
    {
        return static::select('ip_hash')->distinct()->count();
    }
    
    public static function countUniqueVisitsToday(): int
    {
        return static::select('ip_hash')
            ->whereRaw("strftime('%Y-%m-%d', visited_at) = ?", [now()->toDateString()])
            ->distinct()
            ->count();
    }
    
    public static function topVisitedPages(int $limit = 5): array
    {
        return static::select('url', \DB::raw('count(*) as visits_count'))
            ->groupBy('url')
            ->orderByDesc('visits_count')
            ->limit($limit)
            ->get()
            ->toArray();
    }
    
    public static function visitsByDate(int $daysBack = 7): array
    {
        $dates = [];
        $currentDate = now();
        
        for ($i = $daysBack - 1; $i >= 0; $i--) {
            $date = $currentDate->copy()->subDays($i)->toDateString();
            $dates[$date] = 0;
        }
        
        // Używamy strftime dla SQLite
        $results = static::selectRaw("strftime('%Y-%m-%d', visited_at) as date, COUNT(*) as count")
            ->where('visited_at', '>=', now()->subDays($daysBack)->startOfDay())
            ->groupBy('date')
            ->get();
        
        foreach ($results as $result) {
            $dates[$result->date] = $result->count;
        }
        
        return $dates;
    }
    
    public static function visitsByHour(): array
    {
        $hours = [];
        for ($i = 0; $i < 24; $i++) {
            $hours[sprintf('%02d', $i)] = 0;
        }
        
        // Używamy strftime dla SQLite, które nie ma funkcji HOUR
        $results = static::selectRaw("strftime('%H', visited_at) as hour, COUNT(*) as count")
            ->where('visited_at', '>=', now()->subDays(7)->startOfDay())
            ->groupBy('hour')
            ->get();
            
        foreach ($results as $result) {
            $hours[sprintf('%02d', $result->hour)] = $result->count;
        }
        
        return $hours;
    }
    
    public static function visitsByHourSQLite(): array
    {
        $hours = [];
        for ($i = 0; $i < 24; $i++) {
            $hours[$i] = 0;
        }
        
        $results = static::selectRaw("CAST(strftime('%H', visited_at) AS INTEGER) as hour, COUNT(*) as count")
            ->where('visited_at', '>=', now()->subDays(7))
            ->groupBy('hour')
            ->get();
            
        foreach ($results as $result) {
            $hour = (int) $result->hour;
            $hours[$hour] = $result->count;
        }
        
        return $hours;
    }
    
    public static function getTrafficSources(): array
    {
        return static::selectRaw('referrer, COUNT(*) as count')
            ->whereNotNull('referrer')
            ->where('referrer', '<>', '')
            ->groupBy('referrer')
            ->orderByDesc('count')
            ->limit(5)
            ->get()
            ->toArray();
    }
    
    public static function uniqueVisitorsTimeline(int $daysBack = 30): array
    {
        $dates = [];
        $currentDate = now();
        
        for ($i = $daysBack - 1; $i >= 0; $i--) {
            $date = $currentDate->copy()->subDays($i)->toDateString();
            $dates[$date] = 0;
        }
        
        // Używamy strftime dla SQLite
        $results = static::selectRaw("strftime('%Y-%m-%d', visited_at) as date, COUNT(DISTINCT ip_hash) as count")
            ->where('visited_at', '>=', now()->subDays($daysBack)->startOfDay())
            ->groupBy('date')
            ->get();
            
        foreach ($results as $result) {
            $dates[$result->date] = $result->count;
        }
        
        return $dates;
    }
    
    public static function weekOverWeekGrowth(): int
    {
        $thisWeek = static::whereRaw("strftime('%Y-%W', visited_at) = ?", [now()->format('Y-W')])
            ->count();
            
        $lastWeek = static::whereRaw("strftime('%Y-%W', visited_at) = ?", [now()->subWeek()->format('Y-W')])
            ->count();
            
        if ($lastWeek == 0) {
            return $thisWeek > 0 ? 100 : 0;
        }
        
        return (int) round(($thisWeek - $lastWeek) / $lastWeek * 100);
    }
    
    public static function countVisitorsThisWeek(): int
    {
        return static::whereRaw("strftime('%Y-%W', visited_at) = ?", [now()->format('Y-W')])
            ->count();
    }
    
    public static function getAverageVisitsPerDay(): int
    {
        $daysWithData = static::selectRaw("COUNT(DISTINCT strftime('%Y-%m-%d', visited_at)) as days_count")
            ->first()
            ->days_count;
            
        if ($daysWithData == 0) {
            return 0;
        }
        
        return (int) round(static::count() / $daysWithData);
    }
}
