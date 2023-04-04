<?php

namespace App\Console\Commands\Export;

use App\Repositories\Core\SkillRepositoryInterface;

final class SkillExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return SkillRepositoryInterface::class;
    }


    protected function getRelationships(): array
    {
        return [
            'skillGroup',
        ];
    }
}
