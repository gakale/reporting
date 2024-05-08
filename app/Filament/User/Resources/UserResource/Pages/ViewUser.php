<?php

namespace App\Filament\User\Resources\UserResource\Pages;

use App\Filament\User\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'Voir un utilisateur';
}
