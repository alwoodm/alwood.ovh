<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutSettingsResource\Pages;
use App\Filament\Resources\AboutSettingsResource\RelationManagers;
use App\Models\AboutSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutSettingsResource extends Resource
{
    protected static ?string $model = AboutSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    
    protected static ?string $navigationLabel = 'O mnie';
    
    protected static ?string $navigationGroup = 'Zawartość';
    
    protected static ?string $modelLabel = 'Ustawienia sekcji "O mnie"';
    
    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. Najpierw sekcje ogólne
                Forms\Components\Section::make('Informacje podstawowe')
                    ->schema([
                        Forms\Components\TextInput::make('section_title')
                            ->label('Tytuł sekcji')
                            ->maxLength(255)
                            ->default('O mnie'),
                            
                        Forms\Components\RichEditor::make('content')
                            ->label('Treść')
                            ->required()
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                    ]),
                    
                // 2. Sekcja zdjęcia
                Forms\Components\Section::make('Zdjęcie profilowe')
                    ->schema([
                        Forms\Components\Toggle::make('show_image')
                            ->label('Wyświetlaj zdjęcie')
                            ->default(false),
                            
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Zdjęcie profilowe')
                            ->image()
                            ->disk('public')
                            ->directory('profile')
                            ->visible(fn (Forms\Get $get): bool => $get('show_image')),
                            
                        Forms\Components\Select::make('image_position')
                            ->label('Pozycja zdjęcia')
                            ->options([
                                'left' => 'Po lewej stronie',
                                'right' => 'Po prawej stronie',
                            ])
                            ->default('left')
                            ->visible(fn (Forms\Get $get): bool => $get('show_image')),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section_title')
                    ->label('Tytuł sekcji')
                    ->sortable(),
                    
                Tables\Columns\IconColumn::make('show_image')
                    ->label('Zdjęcie')
                    ->boolean(),
                    
                Tables\Columns\TextColumn::make('image_position')
                    ->label('Pozycja zdjęcia')
                    ->formatStateUsing(fn (string $state): string => $state === 'left' ? 'Po lewej' : 'Po prawej')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'left' ? 'info' : 'success'),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ostatnia aktualizacja')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ManageAboutSettings::route('/'),
        ];
    }
}
