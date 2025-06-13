<?php

namespace App\Filament\Resources\SeoSettingsResource\Pages;

use App\Filament\Resources\SeoSettingsResource;
use App\Models\SeoSettings;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;

class ManageSeoSettings extends ManageRecords
{
    protected static string $resource = SeoSettingsResource::class;
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('edit')
                ->label('Edytuj ustawienia')
                ->url(fn (): string => static::getResource()::getUrl('edit', ['record' => SeoSettings::getInstance()])),
                
            Actions\Action::make('clear_cache')
                ->label('Wyczyść cache')
                ->icon('heroicon-o-trash')
                ->color('warning')
                ->requiresConfirmation()
                ->action(function () {
                    Artisan::call('cache:clear');
                    Artisan::call('config:clear');
                    Notification::make()
                        ->title('Cache został wyczyszczony')
                        ->success()
                        ->send();
                }),
        ];
    }
}
