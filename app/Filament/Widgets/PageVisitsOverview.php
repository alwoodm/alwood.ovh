<?php

namespace App\Filament\Widgets;

use App\Models\PageVisit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PageVisitsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    
    protected static ?int $sort = 1;
    
    protected function getStats(): array
    {
        $weekOverWeekGrowth = PageVisit::weekOverWeekGrowth();
        $growthColor = $weekOverWeekGrowth >= 0 ? 'success' : 'danger';
        
        return [
            Stat::make('Wszystkie odwiedziny', PageVisit::countTotalVisits())
                ->description('Łączna liczba odwiedzin')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('primary'),
                
            Stat::make('Dzisiejsze odwiedziny', PageVisit::countTodayVisits())
                ->description('Odwiedziny w dniu dzisiejszym')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                
            Stat::make('Ten tydzień vs poprzedni', $weekOverWeekGrowth . '%')
                ->description('Zmiana w ruchu tydzień do tygodnia')
                ->descriptionIcon($weekOverWeekGrowth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($growthColor),
                
            Stat::make('Unikalni użytkownicy', PageVisit::countUniqueVisits())
                ->description('Łączna liczba unikalnych użytkowników')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('warning'),
                
            Stat::make('Unikalni dzisiaj', PageVisit::countUniqueVisitsToday())
                ->description('Liczba unikalnych użytkowników dzisiaj')
                ->descriptionIcon('heroicon-m-user')
                ->color('info'),
                
            Stat::make('Średnio dziennie', PageVisit::getAverageVisitsPerDay())
                ->description('Średnia liczba odwiedzin dziennie')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),
        ];
    }
}
