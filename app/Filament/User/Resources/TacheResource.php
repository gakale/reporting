<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\CommentaireResource\RelationManagers\TacheRelationManager;
use App\Filament\User\Resources\TacheResource\Pages;
use App\Filament\User\Resources\TacheResource\RelationManagers;
use App\Models\Projet;
use App\Models\Tache;
use App\Models\User;
use DateTime;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;

class TacheResource extends Resource
{
    protected static ?string $model = Tache::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';
    protected static ?string $navigationLabel = 'Taches';
    protected static ?string $navigationGroup = 'Projets Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Information de la tache')
                    ->schema([
                TextInput::make('title'),
                Textarea::make('description'),
                DateTimePicker::make('date_debut'),
                DateTimePicker::make('date_fin'),
                Select::make('projet_id')
                ->options(Projet::all()->pluck('name', 'id'))
                ->searchable()
                    ->label('Projet')
                    ->placeholder('Projet')
                    ->required()
                ,
                Select::make('assigned_to')
                ->options(User::all()->pluck('name', 'id'))
                ->searchable()
                    ->label('Utilisateur')
                    ->placeholder('Utilisateur')
                    ->required()
                ,
                Select::make('priority')
                ->options([
                    'bas' => 'Bas',
                    'moyen' => 'Moyen',
                    'haut' => 'Haut',
                ])
                ->label('Priorité de la tache')
                ->live(true)
                ->columnSpan(2)

                ,

                Select::make('status')
                ->options([
                    'en attente' => 'En attente',
                    'en cours' => 'En cours',
                    'terminé' => 'Terminé',
                ])
                ->label('Status de la tache')

                ->columnSpan(2)
                ,
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('date_debut'),
                Tables\Columns\TextColumn::make('date_fin'),
                Tables\Columns\TextColumn::make('projet.name')
                ->label('Projet')
                ->badge(true)
                ,
                Tables\Columns\TextColumn::make('user.name')
                ->label('Utilisateur assigné')
                ->badge(true)
                ->color('success')
                ,
                Tables\Columns\TextColumn::make('priority')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'bas' => 'info',
                    'moyen' => 'warning',
                    'haut' => 'danger',
                })
                ,
                Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'en attente' => 'info',
                    'pending' => 'warning',
                    'terminé' => 'success',
                    
                })
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            TacheRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaches::route('/'),
            'create' => Pages\CreateTache::route('/create'),
            'edit' => Pages\EditTache::route('/{record}/edit'),
        ];
    }
}
