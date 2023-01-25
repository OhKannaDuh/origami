<?php

namespace App\Filament\Resources\Character\DisadvantageResource\Pages;

use App\Filament\Resources\Character\DisadvantageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDisadvantages extends ListRecords
{
    protected static string $resource = DisadvantageResource::class;


    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
