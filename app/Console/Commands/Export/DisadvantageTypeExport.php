<?php

namespace App\Console\Commands\Export;

use App\Repositories\Core\DisadvantageTypeRepositoryInterface;

final class DisadvantageTypeExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return DisadvantageTypeRepositoryInterface::class;
    }
}
