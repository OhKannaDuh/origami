<?php

namespace App\Console\Commands\Export;

use App\Repositories\Core\AdvantageTypeRepositoryInterface;

final class AdvantageTypeExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return AdvantageTypeRepositoryInterface::class;
    }
}
