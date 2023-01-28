<?php

namespace App\Filament\Resources\Core\SourceBookResource\Pages;

use App\Filament\Resources\Core\SourceBookResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSourceBooks extends ListRecords
{
    protected static string $resource = SourceBookResource::class;


    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
