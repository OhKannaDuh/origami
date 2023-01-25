<?php

namespace App\Filament\Resources\Character;

use App\Filament\Resources\Character\DisadvantageResource\Pages;
use App\Filament\TableHelper;
use App\Models\Character\Disadvantage;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class DisadvantageResource extends Resource
{
    protected static ?string $model = Disadvantage::class;

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
                Forms\Components\Select::make('disadvantage_type_id')
                    ->relationship('disadvantageType', 'name')
                    ->required(),
                Forms\Components\Select::make('ring_id')
                    ->relationship('ring', 'name')
                    ->required(),
                Forms\Components\Select::make('disadvantageCategories')
                    ->searchable(false)
                    ->preload()
                    ->multiple()
                    ->relationship('disadvantageCategories', 'name'),
                TableHelper::richEditor('effects'),
                TableHelper::sourceBook(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('disadvantageType.name'),
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
            'index' => Pages\ListDisadvantages::route('/'),
            'create' => Pages\CreateDisadvantage::route('/create'),
            'edit' => Pages\EditDisadvantage::route('/{record}/edit'),
        ];
    }
}
