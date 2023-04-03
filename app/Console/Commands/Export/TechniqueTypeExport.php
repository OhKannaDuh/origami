<?php

namespace App\Console\Commands\Export;

use App\Repositories\Core\TechniqueTypeRepositoryInterface;

final class TechniqueTypeExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return TechniqueTypeRepositoryInterface::class;
    }
}
