<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Filament\Resources\MessageResource\RelationManagers;
use App\Models\Message;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    
    protected static ?string $navigationGroup = 'Komunikacja';
    
    protected static ?string $navigationLabel = 'Wiadomości';
    
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informacje o wiadomości')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Imię i nazwisko')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('subject')
                            ->label('Temat')
                            ->maxLength(255)
                            ->disabled(),
                        
                        Forms\Components\Textarea::make('message')
                            ->label('Wiadomość')
                            ->rows(6)
                            ->required()
                            ->disabled(),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_read')
                            ->label('Przeczytana')
                            ->default(false)
                            ->reactive(),
                        
                        Forms\Components\DateTimePicker::make('read_at')
                            ->label('Przeczytana dnia')
                            ->hidden(fn (callable $get) => !$get('is_read'))
                            ->disabled(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Przeczytana')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('warning'),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Nadawca')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('subject')
                    ->label('Temat')
                    ->searchable()
                    ->limit(30),
                    
                Tables\Columns\TextColumn::make('message')
                    ->label('Wiadomość')
                    ->limit(50),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data wysłania')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('read_at')
                    ->label('Data odczytu')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->placeholder('-'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('is_read')
                    ->label('Status odczytu')
                    ->options([
                        0 => 'Nieprzeczytane',
                        1 => 'Przeczytane'
                    ])
            ])
            ->actions([
                Tables\Actions\Action::make('mark_as_read')
                    ->label('Oznacz jako przeczytane')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->hidden(fn (Message $record) => $record->is_read)
                    ->action(fn (Message $record) => $record->markAsRead()),
                
                Tables\Actions\Action::make('mark_as_unread')
                    ->label('Oznacz jako nieprzeczytane')
                    ->icon('heroicon-o-envelope')
                    ->color('warning')
                    ->hidden(fn (Message $record) => !$record->is_read)
                    ->action(fn (Message $record) => $record->markAsUnread()),
                    
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('mark_as_read')
                    ->label('Oznacz jako przeczytane')
                    ->icon('heroicon-o-check-circle')
                    ->action(function ($records) {
                        foreach ($records as $record) {
                            $record->markAsRead();
                        }
                    }),
                
                Tables\Actions\BulkAction::make('mark_as_unread')
                    ->label('Oznacz jako nieprzeczytane')
                    ->icon('heroicon-o-envelope')
                    ->action(function ($records) {
                        foreach ($records as $record) {
                            $record->markAsUnread();
                        }
                    }),
                    
                Tables\Actions\DeleteBulkAction::make(),
            ]);
        return $table
            ->columns([
                //
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
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
