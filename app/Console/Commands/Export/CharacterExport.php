<?php

namespace App\Console\Commands\Export;

use App\Repositories\Character\CharacterRepositoryInterface;

final class CharacterExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return CharacterRepositoryInterface::class;
    }


    protected function getRelationships(): array
    {
        return [
            'user',
            'clan',
            'family',
            'school',
            'advantages',
            'disadvantages',
            'techniques',
            'campaigns',
        ];
    }
}
