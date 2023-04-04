<?php

namespace App\Console\Commands\Export;

use App\Repositories\Core\SourceBookRepositoryInterface;

final class SourceBookExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return SourceBookRepositoryInterface::class;
    }


    protected function getRelationships(): array
    {
        return [
            'clans',
            'families',
            'techniques',
            'items',
            'schools',
            'advantages',
            'disadvantages'
        ];
    }
}
