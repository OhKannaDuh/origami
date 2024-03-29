<?php

namespace App\Filament\Resources\Character\SchoolResource\Pages;

use App\Filament\Resources\Character\SchoolResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchools extends ListRecords
{
    protected static string $resource = SchoolResource::class;


    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
