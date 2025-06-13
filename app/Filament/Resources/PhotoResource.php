<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoResource\Pages;
use App\Filament\Resources\PhotoResource\RelationManagers;
use App\Models\Photo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhotoResource extends Resource
{
    protected static ?string $model = Photo::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    
    protected static ?string $navigationGroup = 'Zawartość';
    
    protected static ?string $navigationLabel = 'Zdjęcia';
    
    protected static ?int $navigationSort = 40;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informacje o zdjęciu')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('Tytuł'),
                            
                        Forms\Components\Textarea::make('description')
                            ->nullable()
                            ->maxLength(1000)
                            ->label('Opis'),
                            
                        Forms\Components\TextInput::make('alt_text')
                            ->nullable()
                            ->maxLength(255)
                            ->label('Tekst alternatywny')
                            ->helperText('Tekst wyświetlany, gdy zdjęcie nie może zostać załadowane. Ważny dla dostępności.'),
                            
                        Forms\Components\Select::make('category')
                            ->nullable()
                            ->options([
                                'projekt' => 'Projekt',
                                'galeria' => 'Galeria',
                                'banner' => 'Banner',
                                'inne' => 'Inne',
                            ])
                            ->label('Kategoria'),
                            
                        Forms\Components\Toggle::make('is_featured')
                            ->default(false)
                            ->label('Wyróżnione'),
                            
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->label('Kolejność sortowania'),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Zdjęcie')
                    ->schema([
                        Forms\Components\FileUpload::make('path')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->directory('photos')
                            ->maxSize(5120)
                            ->label('Zdjęcie')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imagePreviewHeight('250')
                            ->imageEditor(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('path')
                    ->label('Podgląd')
                    ->disk('public')
                    ->square(),
                    
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label('Tytuł'),
                    
                Tables\Columns\TextColumn::make('category')
                    ->searchable()
                    ->sortable()
                    ->label('Kategoria'),
                    
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->sortable()
                    ->label('Wyróżnione'),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Utworzono'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategoria')
                    ->options([
                        'projekt' => 'Projekt',
                        'galeria' => 'Galeria', 
                        'banner' => 'Banner',
                        'inne' => 'Inne',
                    ]),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Wyróżnione'),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Utworzone od'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Utworzone do'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->label('Data utworzenia'),
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
            'index' => Pages\ListPhotos::route('/'),
            'create' => Pages\CreatePhoto::route('/create'),
            'edit' => Pages\EditPhoto::route('/{record}/edit'),
        ];
    }
    
    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'description', 'category', 'alt_text'];
    }
}
