<?php

namespace App\Filament\User\Resources\TacheResource\Pages;

use App\Filament\User\Resources\TacheResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Table;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder; // <-- Importez la bonne classe Builder ici



class ListTaches extends ListRecords
{
    protected static string $resource = TacheResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Toutes les tâches'),
            'pending' => Tab::make('En cours')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending')),
            'completed' => Tab::make('Terminées')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'completed')),
            'important' => Tab::make('Importantes')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'important')),
        ];
    }

    


}
