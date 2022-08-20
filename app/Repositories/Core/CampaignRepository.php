<?php

namespace App\Repositories\Core;

use App\Models\Core\Campaign;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends BaseRepository<Campaign>
 */
final class CampaignRepository extends BaseRepository implements CampaignRepositoryInterface
{


    /**
     * @param Campaign $model
     */
    public function __construct(Campaign $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }


    public function getByUuid(string $uuid, array $columns = ['*']): Campaign
    {
        $campaign = $this->execute(__FUNCTION__, fn(): Model => $this->getModel()->query()->where('uuid', $uuid)->firstOrFail($columns));
        assert($campaign instanceof Campaign);

        return $campaign;
    }
}
