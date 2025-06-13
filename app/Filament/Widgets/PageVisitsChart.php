<?php

namespace App\Filament\Widgets;

use App\Models\PageVisit;
use Filament\Widgets\ChartWidget;

class PageVisitsChart extends ChartWidget
{
    protected static ?string $heading = 'Odwiedziny w ostatnich 7 dniach';
    
    protected static ?int $sort = 2;
    
    protected function getData(): array
    {
        $visitsByDate = PageVisit::visitsByDate(7);
        
        return [
            'datasets' => [
                [
                    'label' => 'Odwiedziny',
                    'data' => array_values($visitsByDate),
                    'fill' => false,
                    'borderColor' => '#35BF5C',
                    'backgroundColor' => 'rgba(53, 191, 92, 0.1)',
                    'tension' => 0.4,
                ],
            ],
            'labels' => array_keys($visitsByDate),
        ];
    }
    
    protected function getType(): string
    {
        return 'line';
    }
}
