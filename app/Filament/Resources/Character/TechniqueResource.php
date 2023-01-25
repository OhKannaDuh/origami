<?php

namespace App\Filament\Resources\Character;

use App\Filament\Resources\Character\TechniqueResource\Pages;
use App\Filament\TableHelper;
use App\Models\Character\Technique;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\EditAction;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class TechniqueResource extends Resource
{
    protected static ?string $model = Technique::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';


    public static function form(Form $form): Form
    {

        $description = TableHelper::description([
            'activation',
            'effect',
            'enhancement',
            'burst',
        ]);

        $components = $description->getChildComponents();
        $components[] = Repeater::make('description.opportunities')
            ->schema([
                TextInput::make('cost'),
                RichEditor::make('effect')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'redo',
                        'undo',
                    ])
            ]);

        $description->schema($components);

        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(128),
                TextInput::make('key')
                    ->required()
                    ->maxLength(128),
                TextInput::make('rank')
                    ->required()
                    ->integer(),
                Select::make('technique_subtype_id')
                    ->relationship('techniqueSubtype', 'name')
                    ->required(),
                TableHelper::sourceBook(),
                $description,
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('techniqueSubtype.name'),
                TextColumn::make('rank'),
                TextColumn::make('sourceBook.name'),
                TextColumn::make('page_number'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
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
            'index' => Pages\ListTechniques::route('/'),
            'create' => Pages\CreateTechnique::route('/create'),
            'edit' => Pages\EditTechnique::route('/{record}/edit'),
        ];
    }
}
