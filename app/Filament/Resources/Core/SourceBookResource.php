<?php

namespace App\Filament\Resources\Core;

use App\Filament\Resources\Core\SourceBookResource\Pages;
use App\Filament\Resources\Core\SourceBookResource\RelationManagers;
use App\Models\Core\SourceBook;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SourceBookResource extends Resource
{
    protected static ?string $model = SourceBook::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(64),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(64),
                Forms\Components\TextInput::make('image')
                    ->default('/')
                    ->maxLength(256),
                Forms\Components\Toggle::make('is_official')
                    ->required(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('image'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\IconColumn::make('is_official')
                    ->boolean(),
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
            'index' => Pages\ListSourceBooks::route('/'),
            'create' => Pages\CreateSourceBook::route('/create'),
            'edit' => Pages\EditSourceBook::route('/{record}/edit'),
        ];
    }
}
