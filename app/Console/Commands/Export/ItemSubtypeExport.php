<?php

namespace App\Console\Commands\Export;

use App\Repositories\Core\ItemSubtypeRepositoryInterface;

final class ItemSubtypeExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return ItemSubtypeRepositoryInterface::class;
    }


    protected function getRelationships(): array
    {
        return [
            'itemType',
        ];
    }
}
