<?php

namespace App\Filament\Widgets;

use App\Models\PageVisit;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TopPagesList extends BaseWidget
{
    protected static ?string $heading = 'Najpopularniejsze strony';
    
    protected static ?int $sort = 3;
    
    protected int | string | array $columnSpan = 'full';
    
    public function table(Table $table): Table
    {
        return $table
            ->query(
                PageVisit::query()
                    ->select('url', \DB::raw('count(*) as visits_count'))
                    ->groupBy('url')
                    ->orderByDesc('visits_count')
            )
            ->columns([
                Tables\Columns\TextColumn::make('url')
                    ->label('URL strony')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('visits_count')
                    ->label('Liczba odwiedzin')
                    ->numeric()
                    ->sortable(),
            ])
            ->recordUrl(null)
            ->paginated(false);
    }
    
    public function getTableRecordKey($record): string
    {
        // Zabezpieczenie przed null i konwersja do string
        return (string) ($record->url ?? md5(json_encode($record)));
    }
}
