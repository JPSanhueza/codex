<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileCardResource\Pages;
use App\Models\ProfileCard;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ProfileCardResource extends Resource
{
    protected static ?string $model = ProfileCard::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Perfiles';

    protected static ?string $modelLabel = 'Perfil';

    protected static ?string $pluralModelLabel = 'Perfiles';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->label('Nombre')
                ->required()
                ->maxLength(255),
            FileUpload::make('photo_path')
                ->label('Foto')
                ->image()
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->maxSize(1024)
                ->validationMessages([
                    'max' => 'La imagen no puede superar 1 MB.',
                    'mimetypes' => 'Solo se permiten imágenes JPG, PNG o WEBP.',
                ])
                ->disk('public')
                ->directory('profile-cards')
                ->imageEditor()
                ->columnSpanFull(),
            Repeater::make('bullets')
                ->label('Puntos')
                ->schema([
                    TextInput::make('text')
                        ->label('Punto')
                        ->required(),
                ])
                ->defaultItems(0)
                ->columnSpanFull(),
            Textarea::make('quote')
                ->label('Cita / Nota')
                ->rows(3)
                ->columnSpanFull(),
            TextInput::make('sort_order')
                ->label('Orden')
                ->numeric()
                ->default(0)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\ImageColumn::make('photo_path')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Orden')
                    ->sortable(),
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
            'index' => Pages\ListProfileCards::route('/'),
            'create' => Pages\CreateProfileCard::route('/create'),
            'edit' => Pages\EditProfileCard::route('/{record}/edit'),
        ];
    }
}
