<?php

namespace App\Filament\Resources\Character\AdvantageResource\Pages;

use App\Filament\Actions\NextRecordAction;
use App\Filament\Actions\PreviousRecordAction;
use App\Filament\Resources\Character\AdvantageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdvantage extends EditRecord
{
    protected static string $resource = AdvantageResource::class;


    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            PreviousRecordAction::create(static::$resource, $this->getRecord()),
            NextRecordAction::create(static::$resource, $this->getRecord()),
        ];
    }
}
