<?php

namespace App\Repositories\Character;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Character\Clan;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<Clan>
 */
final class ClanRepository extends BaseRepository implements ClanRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param Clan $model
     */
    public function __construct(Clan $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
