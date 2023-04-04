<?php

namespace App\Console\Commands\Export;

use App\Repositories\Character\TechniqueRepositoryInterface;

final class TechniqueExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return TechniqueRepositoryInterface::class;
    }


    protected function getRelationships(): array
    {
        return [
            'sourceBook',
            'techniqueSubtype',
        ];
    }
}
