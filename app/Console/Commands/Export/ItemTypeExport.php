<?php

namespace App\Console\Commands\Export;

use App\Repositories\Core\ItemTypeRepositoryInterface;

final class ItemTypeExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return ItemTypeRepositoryInterface::class;
    }
}
