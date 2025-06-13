<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\PageVisitsChart;
use App\Filament\Widgets\PageVisitsOverview;
use App\Filament\Widgets\TopPagesList;
use App\Filament\Widgets\HourlyTrafficChart;
use App\Filament\Widgets\GrowthStatsWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';
    
    protected static ?string $navigationLabel = 'Statystyki';
    
    protected static string $view = 'filament.pages.dashboard';
    
    public function getWidgets(): array
    {
        return [
            PageVisitsOverview::class,
            PageVisitsChart::class,
            TopPagesList::class,
            HourlyTrafficChart::class,
            GrowthStatsWidget::class,
        ];
    }
    
    public static function getNavigationBadge(): ?string
    {
        return \App\Models\PageVisit::countTodayVisits();
    }
}
