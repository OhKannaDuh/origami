<?php

namespace App\Filament\Resources\Character\ItemResource\Pages;

use App\Filament\Resources\Character\ItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItems extends ListRecords
{
    protected static string $resource = ItemResource::class;


    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
