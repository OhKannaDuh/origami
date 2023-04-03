<?php

namespace App\Console\Commands\Export;

use App\Repositories\Character\DisadvantageRepositoryInterface;

final class DisadvantageExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return DisadvantageRepositoryInterface::class;
    }


    protected function getRelationships(): array
    {
        return [
            'sourceBook',
            'disadvantageType',
            'ring',
            'disadvantageCategories',
        ];
    }
}
