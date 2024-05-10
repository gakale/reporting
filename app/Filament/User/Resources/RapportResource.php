<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\RapportResource\Pages;
use App\Filament\User\Resources\RapportResource\RelationManagers;
use App\Models\Projet;
use App\Models\Rapport;
use App\Models\Tache;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RapportResource extends Resource
{
    protected static ?string $model = Rapport::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $title = "Rapports";

    protected static ?string $navigationGroup = "Gestion de rapport";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Fieldset::make('Label')
                ->schema([
                    Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Le nom du rapport')
                    ->columnSpan(2),
                    Forms\Components\MarkdownEditor::make('description')
                    ->required()
                    ->label('Description')
                    ->columnSpan(2)
                    ,
                    Forms\Components\Select::make('user_id')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->label('Utilisateur'),
                    Forms\Components\Select::make('tache_id')
                    ->options(Tache::all()->pluck('title', 'id'))
                    ->required()
                    ->searchable()
                    ->label('Tache'),
                    Forms\Components\Select::make('projet_id')
                    ->options(Projet::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->label('Projet'),
                    Forms\Components\Datepicker::make('date_debut')
                    ->required()
                    ->label('Date de debut'),
                    Forms\Components\Datepicker::make('date_fin')
                    ->required()
                    ->label('Date de fin'),
                    Forms\Components\Select::make('status')
                    ->options([
                        'En cours' => 'En cours',
                        'Terminé' => 'Terminé',
                        'En attente' => 'En attente',
                    ])

                ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('description')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                ->label('Utilisateur')
                ->searchable()
                ->sortable()
                ->badge()
                ->color('primary'),
                Tables\Columns\TextColumn::make('tache.title')
                ->label('Tache')
                ->searchable()
                ->sortable()
                ->badge()
                ->color('primary'),
                Tables\Columns\TextColumn::make('projet.name')
                ->label('Projet')
                ->searchable()
                ->sortable()
                ->badge()
                ->color('primary'),
                Tables\Columns\TextColumn::make('date_debut')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('date_fin')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('status')
                ->searchable()
                ->sortable(),
            ])
            ->filters([
                
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRapports::route('/'),
            'create' => Pages\CreateRapport::route('/create'),
            'edit' => Pages\EditRapport::route('/{record}/edit'),
        ];
    }
}
