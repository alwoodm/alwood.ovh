<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingsResource\Pages;
use App\Filament\Resources\SettingsResource\RelationManagers;
use App\Models\Settings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingsResource extends Resource
{
    protected static ?string $model = Settings::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    
    protected static ?string $navigationGroup = 'Zawartość';
    
    protected static ?string $navigationLabel = 'Ustawienia';
    
    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->label('Klucz')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->disabled(fn ($record) => $record !== null),
                
                Forms\Components\TextInput::make('value')
                    ->label('Wartość')
                    ->required()
                    ->maxLength(2048),
                
                Forms\Components\Select::make('group')
                    ->label('Grupa')
                    ->options([
                        'contact' => 'Kontakt',
                        'hero' => 'Sekcja Hero',
                        'portfolio' => 'Portfolio',
                        'footer' => 'Stopka',
                        'general' => 'Ogólne',
                    ])
                    ->required(),
                
                Forms\Components\Textarea::make('description')
                    ->label('Opis')
                    ->maxLength(1000)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Klucz')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('value')
                    ->label('Wartość')
                    ->searchable()
                    ->limit(50),
                
                Tables\Columns\TextColumn::make('group')
                    ->label('Grupa')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'contact' => 'success',
                        'footer' => 'info',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('description')
                    ->label('Opis')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ostatnia aktualizacja')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('Grupa')
                    ->options([
                        'contact' => 'Kontakt',
                        'footer' => 'Stopka',
                        'general' => 'Ogólne',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('key');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSettings::route('/create'),
            'edit' => Pages\EditSettings::route('/{record}/edit'),
        ];
    }
}
