<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';
    
    protected static ?string $navigationGroup = 'Zawartość';
    
    protected static ?string $navigationLabel = 'Projekty';
    
    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. Najpierw sekcje ogólne
                Forms\Components\Section::make('Informacje podstawowe')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Tytuł projektu')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $state, $set) {
                                $set('slug', \Illuminate\Support\Str::slug($state));
                            }),
                            
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                            
                        Forms\Components\Textarea::make('short_description')
                            ->label('Krótki opis')
                            ->required()
                            ->helperText('Krótki opis wyświetlany na liście projektów (maks. 255 znaków)')
                            ->maxLength(255),
                            
                        Forms\Components\RichEditor::make('full_description')
                            ->label('Pełny opis')
                            ->helperText('Szczegółowy opis projektu wyświetlany w modalu szczegółów')
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
                            ]),
                            
                        Forms\Components\TagsInput::make('technologies')
                            ->label('Technologie')
                            ->helperText('Technologie użyte w projekcie, np. Laravel, Filament, Tailwind')
                            ->separator(','),
                            
                        Forms\Components\Select::make('category')
                            ->label('Kategoria projektu')
                            ->options([
                                'osobiste' => 'Osobiste',
                                'wspolpracowane' => 'Współtworzone',
                                'komercyjne' => 'Komercyjne',
                            ])
                            ->default('osobiste')
                            ->required()
                            ->helperText('Kategoria określa charakter projektu'),
                            
                    ]),
                    
                // 2. Sekcja z miniaturą
                Forms\Components\Section::make('Miniatura')
                    ->schema([
                        Forms\Components\Toggle::make('show_thumbnail')
                            ->label('Pokaż miniaturę')
                            ->default(true),
                            
                        Forms\Components\FileUpload::make('thumbnail_path')
                            ->label('Miniatura projektu')
                            ->image()
                            ->visible(fn (Forms\Get $get): bool => $get('show_thumbnail'))
                            ->disk('public')
                            ->directory('projects')
                            ->maxSize(5120)
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imagePreviewHeight('250')
                            ->imageEditor(),
                    ]),
                    
                // 3. Sekcja z linkami
                Forms\Components\Section::make('Linki')
                    ->schema([
                        Forms\Components\TextInput::make('demo_url')
                            ->label('Link do demo')
                            ->url()
                            ->helperText('Link do działającej wersji projektu (opcjonalnie)')
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('code_url')
                            ->label('Link do kodu')
                            ->url()
                            ->helperText('Link do repozytorium z kodem projektu (opcjonalnie)')
                            ->maxLength(255),
                    ]),
                
                // 4. Sekcja z opcjami
                Forms\Components\Section::make('Opcje')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Wyróżniony')
                            ->default(false)
                            ->helperText('Wyróżnione projekty są pokazywane na początku'),
                            
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Kolejność sortowania')
                            ->numeric()
                            ->default(0)
                            ->helperText('Projekty są sortowane rosnąco wg tej wartości'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 1. Podstawowe kolumny identyfikacyjne
                Tables\Columns\ImageColumn::make('thumbnail_path')
                    ->label('Miniatura')
                    ->disk('public')
                    ->visibility(fn ($record) => $record->show_thumbnail ? 'visible' : 'hidden')
                    ->square(),
                    
                Tables\Columns\TextColumn::make('title')
                    ->label('Tytuł')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                // 2. Kolumny opisowe
                Tables\Columns\TextColumn::make('short_description')
                    ->label('Krótki opis')
                    ->limit(50)
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('technologies')
                    ->label('Technologie')
                    ->badge(),
                
                Tables\Columns\TextColumn::make('category')
                    ->label('Kategoria')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'osobiste' => 'primary',
                        'wspolpracowane' => 'warning',
                        'komercyjne' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'osobiste' => 'Osobiste',
                        'wspolpracowane' => 'Współtworzone',
                        'komercyjne' => 'Komercyjne',
                        default => $state,
                    }),
                    
                // 3. Kolumny stanu/statusu
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Wyróżniony')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('gray'),
                    
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Kolejność')
                    ->sortable(),
                    
                // 4. Kolumny dat
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ostatnia aktualizacja')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Tylko wyróżnione'),
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategoria')
                    ->options([
                        'osobiste' => 'Osobiste',
                        'wspolpracowane' => 'Współtworzone',
                        'komercyjne' => 'Komercyjne',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc');
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
    
    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'short_description', 'full_description', 'technologies'];
    }
}
