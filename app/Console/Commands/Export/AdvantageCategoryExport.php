<?php

namespace App\Console\Commands\Export;

use App\Repositories\Core\AdvantageCategoryRepositoryInterface;

final class AdvantageCategoryExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return AdvantageCategoryRepositoryInterface::class;
    }
}
