<?php

namespace App\Filament\Resources\Core\DisadvantageCategoryResource\Pages;

use App\Filament\Resources\Core\DisadvantageCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDisadvantageCategory extends EditRecord
{
    protected static string $resource = DisadvantageCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
