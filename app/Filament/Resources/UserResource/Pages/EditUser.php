<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('resetPassword')
                ->label('Resetuj hasło')
                ->color('warning')
                ->icon('heroicon-o-key')
                ->form([
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->label('Nowe hasło')
                        ->required()
                        ->dehydrated(false),
                    Forms\Components\TextInput::make('password_confirmation')
                        ->password()
                        ->label('Potwierdź nowe hasło')
                        ->required()
                        ->dehydrated(false)
                        ->same('password')
                        ->validationAttribute('Potwierdzenie hasła'),
                ])
                ->action(function (array $data, Model $record): void {
                    $record->update([
                        'password' => Hash::make($data['password']),
                    ]);
                    $this->notify('success', 'Hasło zostało zresetowane');
                }),
        ];
    }
}
