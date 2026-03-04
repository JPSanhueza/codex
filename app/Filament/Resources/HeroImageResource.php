<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroImageResource\Pages;
use App\Models\HeroImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HeroImageResource extends Resource
{
    protected static ?string $model = HeroImage::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Imagen Hero';

    protected static ?string $pluralModelLabel = 'Imágenes Hero';

    protected static ?string $modelLabel = 'Imagen Hero';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('desktop_image_path')
                    ->label('Imagen de escritorio')
                    ->image()
                    ->disk('public')
                    ->directory('hero-images')
                    ->required(),
                Forms\Components\FileUpload::make('mobile_image_path')
                    ->label('Imagen de celular')
                    ->image()
                    ->disk('public')
                    ->directory('hero-images')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('desktop_image_path')
                    ->label('Desktop')
                    ->disk('public'),
                Tables\Columns\ImageColumn::make('mobile_image_path')
                    ->label('Celular')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creada')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroImages::route('/'),
            'create' => Pages\CreateHeroImage::route('/create'),
            'edit' => Pages\EditHeroImage::route('/{record}/edit'),
        ];
    }
}
