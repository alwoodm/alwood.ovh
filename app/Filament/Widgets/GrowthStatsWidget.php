<?php

namespace App\Filament\Widgets;

use App\Models\PageVisit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GrowthStatsWidget extends BaseWidget
{
    protected static ?int $sort = 6;
    
    protected function getStats(): array
    {
        $growth = PageVisit::weekOverWeekGrowth();
        $color = $growth >= 0 ? 'success' : 'danger';
        $icon = $growth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $topPageUrl = $this->getTopPageUrl();
        $topPageVisits = $this->getTopPageVisits();
        
        return [
            Stat::make('Odwiedziny w tym tygodniu', PageVisit::countVisitorsThisWeek())
                ->description('Zmiana: ' . $growth . '%')
                ->descriptionIcon($icon)
                ->chart([$growth >= 0 ? 50 : 70, $growth >= 0 ? 70 : 50])
                ->color($color),
                
            Stat::make('Średnio dziennie', PageVisit::getAverageVisitsPerDay())
                ->description('Średnia liczba dziennych odwiedzin')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),
                
            Stat::make('Najlepszy URL', $topPageUrl)
                ->description($topPageVisits)
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
        ];
    }
    
    protected function getTopPageUrl(): string
    {
        $topPages = PageVisit::topVisitedPages(1);
        return !empty($topPages) ? $topPages[0]['url'] : '-';
    }
    
    protected function getTopPageVisits(): string
    {
        $topPages = PageVisit::topVisitedPages(1);
        return !empty($topPages) ? $topPages[0]['visits_count'] . ' odwiedzin' : '';
    }
}
