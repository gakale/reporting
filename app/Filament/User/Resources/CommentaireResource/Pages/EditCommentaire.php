<?php

namespace App\Filament\User\Resources\CommentaireResource\Pages;

use App\Filament\User\Resources\CommentaireResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommentaire extends EditRecord
{
    protected static string $resource = CommentaireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
