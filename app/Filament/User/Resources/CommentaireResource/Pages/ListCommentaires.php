<?php

namespace App\Filament\User\Resources\CommentaireResource\Pages;

use App\Filament\User\Resources\CommentaireResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCommentaires extends ListRecords
{
    protected static string $resource = CommentaireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
