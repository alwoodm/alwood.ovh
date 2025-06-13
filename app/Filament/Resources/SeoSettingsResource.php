<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeoSettingsResource\Pages;
use App\Models\SeoSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SeoSettingsResource extends Resource
{
    protected static ?string $model = SeoSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    
    protected static ?string $navigationLabel = 'Ustawienia SEO';
    
    protected static ?string $navigationGroup = 'Administracja';
    
    protected static ?string $modelLabel = 'Ustawienia SEO';
    
    protected static ?string $pluralModelLabel = 'Ustawienia SEO';
    
    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Podstawowe ustawienia SEO')
                    ->schema([
                        Forms\Components\TextInput::make('site_title')
                            ->label('Tytuł strony')
                            ->helperText('To będzie wyświetlane w tytule karty przeglądarki')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\Textarea::make('site_description')
                            ->label('Opis strony')
                            ->helperText('Krótki opis strony - będzie widoczny w wynikach wyszukiwania')
                            ->maxLength(500),
                            
                        Forms\Components\Textarea::make('site_keywords')
                            ->label('Słowa kluczowe')
                            ->helperText('Rozdziel słowa kluczowe przecinkami')
                            ->maxLength(500),
                    ]),
                    
                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\FileUpload::make('favicon_path')
                            ->label('Favicon')
                            ->helperText('Ikona strony wyświetlana w zakładce przeglądarki. Zalecany rozmiar: 32x32 px lub 16x16 px. Format: .ico, .png')
                            ->image()
                            ->disk('public')
                            ->directory('seo')
                            ->imagePreviewHeight('50'),
                            
                        Forms\Components\FileUpload::make('og_image_path')
                            ->label('Obraz Open Graph')
                            ->helperText('Obraz wyświetlany przy udostępnianiu strony na Facebooku, Messengerze, itp. Zalecany rozmiar: 1200x630 px')
                            ->image()
                            ->disk('public')
                            ->directory('seo')
                            ->imagePreviewHeight('100')
                            ->imageEditor(),
                            
                        Forms\Components\FileUpload::make('twitter_image_path')
                            ->label('Obraz Twitter Card')
                            ->helperText('Obraz wyświetlany przy udostępnianiu na Twitterze. Zalecany rozmiar: 1200x600 px')
                            ->image()
                            ->disk('public')
                            ->directory('seo')
                            ->imagePreviewHeight('100')
                            ->imageEditor(),
                    ]),
                    
                Forms\Components\Section::make('Zaawansowane')
                    ->schema([
                        Forms\Components\TextInput::make('google_analytics_id')
                            ->label('ID Google Analytics')
                            ->helperText('Np. UA-XXXXX-Y lub G-XXXXXXXX')
                            ->maxLength(50),
                            
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Toggle::make('use_site_name_in_title')
                                    ->label('Dodawaj nazwę strony do tytułu podstron')
                                    ->default(true),
                                    
                                Forms\Components\TextInput::make('title_separator')
                                    ->label('Separator tytułu')
                                    ->default(' - ')
                                    ->maxLength(10),
                            ]),
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
            'index' => Pages\ManageSeoSettings::route('/'),
            'edit' => Pages\EditSeoSettings::route('/{record}/edit'),
        ];
    }
}
