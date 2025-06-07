<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMessage extends CreateRecord
{
    protected static string $resource = MessageResource::class;
    
    /**
     * Przekierowanie po próbie dostępu do strony tworzenia wiadomości
     */
    public function mount(): void
    {
        // Przekieruj do listy wiadomości, ponieważ nie chcemy umożliwiać tworzenia wiadomości z panelu
        $this->redirect(static::getResource()::getUrl('index'));
    }
}
