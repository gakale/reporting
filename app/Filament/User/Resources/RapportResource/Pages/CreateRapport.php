<?php

namespace App\Filament\User\Resources\RapportResource\Pages;

use App\Filament\User\Resources\RapportResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRapport extends CreateRecord
{
    protected static string $resource = RapportResource::class;
    protected static ?string $title = 'Crée un  Rapport';


}
