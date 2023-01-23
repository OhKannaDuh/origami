<?php

namespace App\Filament\Resources\Core;

use App\Filament\Resources\Core\AdvantageCategoryResource\Pages;
use App\Filament\Resources\Core\AdvantageCategoryResource\RelationManagers;
use App\Models\Core\AdvantageCategory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdvantageCategoryResource extends Resource
{
    protected static ?string $model = AdvantageCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(32),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(32),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListAdvantageCategories::route('/'),
            'create' => Pages\CreateAdvantageCategory::route('/create'),
            'edit' => Pages\EditAdvantageCategory::route('/{record}/edit'),
        ];
    }    
}
