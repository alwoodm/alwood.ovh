<?php

namespace App\Filament\Resources\AboutSettingsResource\Pages;

use App\Filament\Resources\AboutSettingsResource;
use App\Models\AboutSettings;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Resources\Pages\ManageRecords;

class ManageAboutSettings extends ManageRecords
{
    protected static string $resource = AboutSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn () => !AboutSettings::exists())
                ->label('Utwórz ustawienia'),
        ];
    }
}
