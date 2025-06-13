<?php

namespace App\Filament\Widgets;

use App\Models\PageVisit;
use Filament\Widgets\ChartWidget;

class HourlyTrafficChart extends ChartWidget
{
    protected static ?string $heading = 'Ruch według godzin (ostatnie 7 dni)';
    
    protected static ?int $sort = 4;
    
    protected function getData(): array
    {
        $visitsByHour = []; 
        
        // Inicjalizacja tablicy dla 24 godzin z wartościami 0
        for ($hour = 0; $hour < 24; $hour++) {
            $visitsByHour[$hour] = 0;
        }
        
        // Pobieranie danych z modelu
        $results = PageVisit::visitsByHourSQLite();
        
        // Wypełnianie tablicy rzeczywistymi danymi
        foreach ($results as $hour => $count) {
            if (isset($visitsByHour[$hour])) {
                $visitsByHour[$hour] = $count;
            }
        }
        
        return [
            'datasets' => [
                [
                    'label' => 'Liczba odwiedzin',
                    'data' => array_values($visitsByHour),
                    'backgroundColor' => 'rgba(53, 191, 92, 0.7)',
                    'borderColor' => '#35BF5C',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => array_map(function ($hour) {
                return $hour . ':00';
            }, array_keys($visitsByHour)),
        ];
    }
    
    protected function getType(): string
    {
        return 'bar';
    }
}
