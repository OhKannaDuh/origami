<?php

namespace App\Console\Commands\Export;

use App\Repositories\Core\RingRepositoryInterface;

final class RingExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return RingRepositoryInterface::class;
    }
}
