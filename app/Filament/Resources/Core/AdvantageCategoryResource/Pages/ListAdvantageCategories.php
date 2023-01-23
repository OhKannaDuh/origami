<?php

namespace App\Filament\Resources\Core\AdvantageCategoryResource\Pages;

use App\Filament\Resources\Core\AdvantageCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdvantageCategories extends ListRecords
{
    protected static string $resource = AdvantageCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
