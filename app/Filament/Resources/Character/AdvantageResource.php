<?php

namespace App\Filament\Resources\Character;

use App\Filament\Resources\Character\AdvantageResource\Pages;
use App\Filament\TableHelper;
use App\Models\Character\Advantage;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class AdvantageResource extends Resource
{
    protected static ?string $model = Advantage::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('advantage_type_id')
                    ->relationship('advantageType', 'name')
                    ->required(),
                Forms\Components\Select::make('ring_id')
                    ->relationship('ring', 'name')
                    ->required(),
                Forms\Components\Select::make('advantageCategories')
                    ->searchable(false)
                    ->preload()
                    ->multiple()
                    ->relationship('advantageCategories', 'name'),
                TableHelper::richEditor('effects'),
                TableHelper::sourceBook(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('advantageType.name'),
                Tables\Columns\TextColumn::make('ring.name'),
                Tables\Columns\TextColumn::make('sourceBook.name'),
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
            'index' => Pages\ListAdvantages::route('/'),
            'create' => Pages\CreateAdvantage::route('/create'),
            'edit' => Pages\EditAdvantage::route('/{record}/edit'),
        ];
    }
}
