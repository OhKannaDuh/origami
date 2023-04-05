<?php

namespace App\Filament\Resources\Character\ItemResource\Pages;

use App\Filament\Resources\Character\ItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateItem extends CreateRecord
{
    protected static string $resource = ItemResource::class;
}
