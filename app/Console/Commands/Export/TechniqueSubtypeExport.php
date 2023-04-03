<?php

namespace App\Console\Commands\Export;

use App\Repositories\Core\TechniqueSubtypeRepositoryInterface;

final class TechniqueSubtypeExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return TechniqueSubtypeRepositoryInterface::class;
    }


    protected function getRelationships(): array
    {
        return [
            'techniqueType',
        ];
    }
}
