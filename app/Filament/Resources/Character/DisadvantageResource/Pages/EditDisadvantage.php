<?php

namespace App\Filament\Resources\Character\DisadvantageResource\Pages;

use App\Filament\Actions\NextRecordAction;
use App\Filament\Actions\PreviousRecordAction;
use App\Filament\Resources\Character\DisadvantageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDisadvantage extends EditRecord
{
    protected static string $resource = DisadvantageResource::class;


    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            PreviousRecordAction::create(static::$resource, $this->getRecord()),
            NextRecordAction::create(static::$resource, $this->getRecord()),
        ];
    }
}
