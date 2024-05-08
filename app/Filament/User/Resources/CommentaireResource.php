<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\CommentaireResource\Pages;
use App\Filament\User\Resources\CommentaireResource\RelationManagers;
use App\Models\Commentaire;
use App\Models\Tache;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Fieldset;

class CommentaireResource extends Resource
{
    protected static ?string $model = Commentaire::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center';
    protected static ?string $navigationLabel = 'Commentaires';
    protected static ?string $navigationGroup = 'Projets Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Fieldset::make('Label')
                ->schema([
                Forms\Components\Textarea::make('content')
                    ->required(),
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

                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('content')
                ->limit(50)
                ,
                Tables\Columns\TextColumn::make('user.name')
                ->label('Utilisateur')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCommentaires::route('/'),
            'create' => Pages\CreateCommentaire::route('/create'),
            'edit' => Pages\EditCommentaire::route('/{record}/edit'),
            'view' => Pages\ViewCommentaire::route('/{record}'),
        ];
    }
}
