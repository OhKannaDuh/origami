<?php

namespace App\Filament\Resources\Core\DisadvantageCategoryResource\Pages;

use App\Filament\Resources\Core\DisadvantageCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDisadvantageCategories extends ListRecords
{
    protected static string $resource = DisadvantageCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
