<?php

namespace App\Console\Commands\Export;

use App\Repositories\Character\AdvantageRepositoryInterface;

final class AdvantageExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return AdvantageRepositoryInterface::class;
    }


    protected function getRelationships(): array
    {
        return [
            'sourceBook',
            'advantageType',
            'ring',
            'advantageCategories'
        ];
    }
}
