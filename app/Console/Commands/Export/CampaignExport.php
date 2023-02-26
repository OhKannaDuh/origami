<?php

namespace App\Console\Commands\Export;

use App\Repositories\Core\CampaignRepositoryInterface;

final class CampaignExport extends Export
{


    protected function getRepositoryClass(): string
    {
        return CampaignRepositoryInterface::class;
    }


    protected function getRelationships(): array
    {
        return [
            'characters',
            'users',
        ];
    }
}
