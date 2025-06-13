<?php

namespace App\Filament\Resources\SeoSettingsResource\Pages;

use App\Filament\Resources\SeoSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;

class EditSeoSettings extends EditRecord
{
    protected static string $resource = SeoSettingsResource::class;
    
    protected function getHeaderActions(): array
    {
        return [
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
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Ustawienia SEO zostały zaktualizowane')
            ->success();
    }
}
