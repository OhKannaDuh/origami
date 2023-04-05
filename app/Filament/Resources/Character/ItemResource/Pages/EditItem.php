<?php

namespace App\Filament\Resources\Character\ItemResource\Pages;

use App\Filament\Resources\Character\ItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItem extends EditRecord
{
    protected static string $resource = ItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
