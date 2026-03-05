<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Mensajes de contacto';

    protected static ?string $modelLabel = 'Mensaje de contacto';

    protected static ?string $pluralModelLabel = 'Mensajes de contacto';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')->label('Nombre')->disabled(),
            TextInput::make('email')->label('Email')->disabled(),
            TextInput::make('ip_address')->label('IP')->disabled(),
            Textarea::make('message')->label('Mensaje')->rows(8)->columnSpanFull()->disabled(),
            Textarea::make('user_agent')->label('User Agent')->rows(3)->columnSpanFull()->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Recibido')->dateTime()->sortable(),
            ])
            ->filters([
                Filter::make('hoy')
                    ->label('Hoy')
                    ->query(fn ($query) => $query->whereDate('created_at', now()->toDateString())),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
