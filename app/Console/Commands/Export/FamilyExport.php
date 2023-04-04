<?php

namespace App\Console\Commands\Export;

use App\Repositories\Character\FamilyRepositoryInterface;

final class FamilyExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return FamilyRepositoryInterface::class;
    }


    protected function getRelationships(): array
    {
        return [
            'sourceBook',
            'clan',
            'ringChoiceOne',
            'ringChoiceTwo',
            'skillOne',
            'skillTwo',
        ];
    }
}
