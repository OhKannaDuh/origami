<?php

namespace App\Filament\Resources\Character;

use App\Filament\Resources\Character\ItemResource\Pages;
use App\Filament\Resources\Character\ItemResource\RelationManagers;
use App\Filament\TableHelper;
use App\Models\Character\Item;
use App\Repositories\Core\ItemSubtypeRepositoryInterface;
use App\Repositories\Core\ItemTypeRepositoryInterface;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\App;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';


    public static function form(Form $form): Form
    {
        $subtypes = App::make(ItemSubtypeRepositoryInterface::class);
        assert($subtypes instanceof ItemSubtypeRepositoryInterface);

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(64),
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(64),

                Forms\Components\Select::make('item_subtype_id')
                    ->relationship('itemSubtype', 'name')
                    ->required(),
                Forms\Components\TextInput::make('rarity')
                        ->required(),
                Grid::make(1)
                    ->schema([
                        Forms\Components\Textarea::make('description')
                        ->required()
                        ->maxLength(65535),
                    ]),
                Fieldset::make('Cost')
                        ->columns(3)
                        ->schema([
                            TextInput::make('cost.koku'),
                            TextInput::make('cost.bu'),
                            TextInput::make('cost.zeni')
                        ]),
                Fieldset::make('Weapon Data')
                    ->columns(2)
                    ->hidden(function (\Closure $get) use ($subtypes): bool {
                        $subtype = $subtypes->getById($get('item_subtype_id'));
                        return $subtype->itemType->key !== 'weapon';
                    })
                    ->schema([
                        Grid::make(1)
                        ->schema([
                            Select::make('data.skill_key')
                            ->options([
                                'martial_arts_melee' => 'Martial Arts (Melee)',
                                'martial_arts_ranged' => 'Martial Arts (Ranged)',
                                'martial_arts_unarmed' => 'Martial Arts (Unarmed)',
                            ]),
                        ]),
                        TextInput::make('data.range.min')
                            ->label('Min Range'),
                        TextInput::make('data.range.max')
                            ->label('Max Range'),
                        TextInput::make('data.damage'),
                        TextInput::make('data.deadliness'),
                        TextInput::make('data.grips.1')
                            ->label('1 Handed Grip'),
                        TextInput::make('data.grips.2')
                            ->label('2 Handed Grip'),
                    ]),
                Fieldset::make('Weapon Data')
                    ->columns(2)
                    ->hidden(function (\Closure $get) use ($subtypes): bool {
                        $subtype = $subtypes->getById($get('item_subtype_id'));
                        return $subtype->itemType->key !== 'armor';
                    })
                    ->schema([
                        TextInput::make('data.physical'),
                        TextInput::make('data.supernatural'),
                    ]),

                TableHelper::sourceBook(),
            ]);
    }


        // return Fieldset::make('Source')
        //     ->columns(1)
        //     ->schema([
        //         Select::make('source_book_id')
        //             ->relationship('sourceBook', 'name')
        //             ->required(),
        //         TextInput::make('page_number')
        //             ->integer(),
        //     ]);


    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('sourceBook.name'),
            Tables\Columns\TextColumn::make('itemSubtype.name'),
            Tables\Columns\TextColumn::make('key'),
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\TextColumn::make('page_number'),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
