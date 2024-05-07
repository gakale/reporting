<?php

namespace App\Filament\User\Resources\RapportResource\Pages;

use App\Filament\User\Resources\RapportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRapport extends EditRecord
{
    protected static string $resource = RapportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
