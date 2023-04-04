<?php

namespace App\Console\Commands\Export;

use App\Repositories\Core\DisadvantageCategoryRepositoryInterface;

final class DisadvantageCategoryExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return DisadvantageCategoryRepositoryInterface::class;
    }
}
