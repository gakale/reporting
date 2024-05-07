<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\ProjetResource\Pages;
use App\Filament\User\Resources\ProjetResource\RelationManagers;
use App\Models\Projet;
use App\Models\User;
use DateTime;
use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Support\Markdown;
use League\CommonMark\Input\MarkdownInput;

class ProjetResource extends Resource
{
    protected static ?string $model = Projet::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';
    protected static ?string $navigationLabel = 'Projets';
    protected static ?string $navigationGroup = 'Projets Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Information du projet')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom du projet')
                            ->placeholder('Nom du projet')
                            ->required()
                        ,
                        MarkdownEditor::make('description')
                            ->label('Description du projet')
                            ->placeholder('Description du projet')
                            ->required()
                        ,
                        DateTimePicker::make('date_debut')
                            ->label('Date de début')
                            ->placeholder('Date de début')
                            ->required()
                        ,
                        DateTimePicker::make('date_fin')
                            ->label('Date de fin')
                            ->placeholder('Date de fin')
                            ->required()
                        ,
                        TextInput::make('budget')
                            ->label('Budget')
                            ->placeholder('Budget')
                            ->required()
                        ,

                        Select::make('user_id')
                        ->options(User::all()->pluck('name', 'id'))
                        ->searchable()
                            ->label('Utilisateur')
                            ->placeholder('Utilisateur')
                            ->required()
                        ,
                        TextInput::make('status')
                            ->label('Status')
                            ->placeholder('Status')
                            ->required()
                        ,
                    ])

                ,


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjets::route('/'),
            'create' => Pages\CreateProjet::route('/create'),
            'edit' => Pages\EditProjet::route('/{record}/edit'),
        ];
    }
}
