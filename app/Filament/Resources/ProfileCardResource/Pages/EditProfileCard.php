<?php

namespace App\Filament\Resources\ProfileCardResource\Pages;

use App\Filament\Resources\ProfileCardResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProfileCard extends EditRecord
{
    protected static string $resource = ProfileCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
