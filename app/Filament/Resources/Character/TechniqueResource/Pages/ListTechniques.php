<?php

namespace App\Filament\Resources\Character\TechniqueResource\Pages;

use App\Filament\Resources\Character\TechniqueResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTechniques extends ListRecords
{
    protected static string $resource = TechniqueResource::class;


    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
