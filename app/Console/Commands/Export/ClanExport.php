<?php

namespace App\Console\Commands\Export;

use App\Repositories\Character\ClanRepositoryInterface;

final class ClanExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return ClanRepositoryInterface::class;
    }


    protected function getRelationships(): array
    {
        return [
            'sourceBook',
            'ring',
            'skill',
        ];
    }
}
