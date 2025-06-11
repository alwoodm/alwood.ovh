<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSettingsResource\Pages;
use App\Models\HeroSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HeroSettingsResource extends Resource
{
    protected static ?string $model = HeroSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static ?string $navigationLabel = 'Sekcja powitalna';
    
    protected static ?string $navigationGroup = 'Zawartość';
    
    protected static ?string $modelLabel = 'Sekcja powitalna';
    
    protected static ?string $pluralModelLabel = 'Sekcja powitalna';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Zawartość sekcji powitalnej')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Tytuł (imię)')
                            ->placeholder('np. Jan Kowalski')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label('Opis')
                            ->placeholder('Krótki opis twojej osoby/działalności')
                            ->required(),
                    ]),
                Forms\Components\Section::make('Przyciski')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('primary_button_text')
                                    ->label('Tekst głównego przycisku')
                                    ->placeholder('np. Zobacz projekty')
                                    ->required(),
                                Forms\Components\TextInput::make('primary_button_url')
                                    ->label('URL głównego przycisku')
                                    ->placeholder('np. #portfolio')
                                    ->required(),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('secondary_button_text')
                                    ->label('Tekst drugiego przycisku')
                                    ->placeholder('np. Skontaktuj się')
                                    ->required(),
                                Forms\Components\TextInput::make('secondary_button_url')
                                    ->label('URL drugiego przycisku')
                                    ->placeholder('np. #kontakt')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Tytuł'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Opis')
                    ->limit(50),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ostatnia aktualizacja')
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListHeroSettings::route('/'),
            'create' => Pages\CreateHeroSettings::route('/create'),
            'edit' => Pages\EditHeroSettings::route('/{record}/edit'),
        ];
    }
}
