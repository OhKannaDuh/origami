<?php

namespace App\Filament\Resources\Core\AdvantageCategoryResource\Pages;

use App\Filament\Resources\Core\AdvantageCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdvantageCategory extends EditRecord
{
    protected static string $resource = AdvantageCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
