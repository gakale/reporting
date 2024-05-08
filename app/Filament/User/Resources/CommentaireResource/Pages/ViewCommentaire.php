<?php

namespace App\Filament\User\Resources\CommentaireResource\Pages;

use App\Filament\User\Resources\CommentaireResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCommentaire extends ViewRecord
{
    protected static string $resource = CommentaireResource::class;

    protected static ?string $title = 'Voir un commentaire';

}
