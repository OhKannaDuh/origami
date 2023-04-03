<?php

namespace App\Console\Commands\Export;

use App\Repositories\Core\SkillGroupRepositoryInterface;

final class SkillGroupExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return SkillGroupRepositoryInterface::class;
    }
}
