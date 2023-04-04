<?php

namespace App\Console\Commands\Export;

use App\Repositories\Character\ItemRepositoryInterface;

final class ItemExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return ItemRepositoryInterface::class;
    }


    protected function getRelationships(): array
    {
        return [
            'sourceBook',
            'itemSubtype',
        ];
    }
}
