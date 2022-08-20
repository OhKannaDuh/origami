<?php

namespace App\Repositories\Core;

use App\Models\Core\Campaign;
use App\Repositories\RepositoryInterface;

/**
 * @extends RepositoryInterface<Campaign>
 */
interface CampaignRepositoryInterface extends RepositoryInterface
{


    /**
     * @param string $uuid
     *
     * @return Campaign
     */
    public function getByUuid(string $uuid): Campaign;
}
