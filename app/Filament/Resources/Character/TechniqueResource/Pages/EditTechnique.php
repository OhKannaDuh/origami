<?php

namespace App\Filament\Resources\Character\TechniqueResource\Pages;

use App\Filament\Actions\NextRecordAction;
use App\Filament\Actions\PreviousRecordAction;
use App\Filament\Resources\Character\TechniqueResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTechnique extends EditRecord
{
    protected static string $resource = TechniqueResource::class;


    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            PreviousRecordAction::create(static::$resource, $this->getRecord()),
            NextRecordAction::create(static::$resource, $this->getRecord()),
        ];
    }
}
