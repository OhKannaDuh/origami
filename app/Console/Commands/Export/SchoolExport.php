<?php

namespace App\Console\Commands\Export;

use App\Repositories\Character\SchoolRepositoryInterface;

final class SchoolExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return SchoolRepositoryInterface::class;
    }


    protected function getRelationships(): array
    {
        return [
            'sourceBook',
            'ringOne',
            'ringTwo',
            'family',
            'availableTechniqueTypes',
            'availableTechniqueSubtypes',
            'schoolTypes',
        ];
    }
}
