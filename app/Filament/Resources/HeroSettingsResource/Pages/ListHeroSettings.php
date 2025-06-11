<?php

namespace App\Filament\Resources\HeroSettingsResource\Pages;

use App\Filament\Resources\HeroSettingsResource;
use Filament\Resources\Pages\ListRecords;

class ListHeroSettings extends ListRecords
{
    protected static string $resource = HeroSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
