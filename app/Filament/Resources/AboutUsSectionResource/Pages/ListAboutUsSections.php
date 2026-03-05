<?php

namespace App\Filament\Resources\AboutUsSectionResource\Pages;

use App\Filament\Resources\AboutUsSectionResource;
use App\Models\AboutUsSection;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAboutUsSections extends ListRecords
{
    protected static string $resource = AboutUsSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->visible(fn (): bool => ! AboutUsSection::query()->exists()),
        ];
    }
}
