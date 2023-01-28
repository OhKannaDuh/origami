<?php

namespace App\Filament\Resources\Character;

use App\Filament\Resources\Character\SchoolResource\Pages;
use App\Filament\Resources\Character\SchoolResource\RelationManagers;
use App\Models\Character\School;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('source_book_id')
                    ->relationship('sourceBook', 'name')
                    ->required(),
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(64),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(64),
                Forms\Components\TextInput::make('ring_mode')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('ring_one_id')
                    ->relationship('ringOne', 'name'),
                Forms\Components\Select::make('ring_two_id')
                    ->relationship('ringTwo', 'name'),
                Forms\Components\TextInput::make('starting_skill_amount')
                    ->required(),
                Forms\Components\Textarea::make('starting_skills')
                    ->required(),
                Forms\Components\Textarea::make('starting_techniques')
                    ->required(),
                Forms\Components\Textarea::make('starting_outfit')
                    ->required(),
                Forms\Components\Textarea::make('curriculum')
                    ->required(),
                Forms\Components\TextInput::make('school_ability_id'),
                Forms\Components\TextInput::make('mastery_ability_id'),
                Forms\Components\Select::make('family_id')
                    ->relationship('family', 'name'),
                Forms\Components\TextInput::make('honor')
                    ->required(),
                Forms\Components\TextInput::make('page_number'),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('family.name'),
                Tables\Columns\TextColumn::make('honor'),
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
            'index' => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchool::route('/create'),
            'edit' => Pages\EditSchool::route('/{record}/edit'),
        ];
    }
}
