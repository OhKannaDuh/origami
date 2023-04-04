<?php

namespace App\Console\Commands\Export;

use App\Repositories\Core\SchoolTypeRepositoryInterface;

final class SchoolTypeExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return SchoolTypeRepositoryInterface::class;
    }
}
