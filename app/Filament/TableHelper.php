<?php

namespace App\Filament;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\RichEditor;

final class TableHelper
{


    public static function sourceBook(): Fieldset
    {
        return Fieldset::make('Source')
            ->columns(1)
            ->schema([
                Select::make('source_book_id')
                    ->relationship('sourceBook', 'name')
                    ->required(),
                TextInput::make('page_number')
                    ->integer(),
            ]);
    }


    public static function description(array $keys): Fieldset
    {
        $schema = [];
        foreach ($keys as $key) {
            $schema[] = RichEditor::make('description.' . $key)
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'redo',
                    'undo',
                ]);
        }

        return Fieldset::make('Description')
            ->columns(1)
            ->schema($schema);
    }
}
