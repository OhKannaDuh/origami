<?php

namespace App\Repositories\Character;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Character\Family;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<Family>
 */
final class FamilyRepository extends BaseRepository implements FamilyRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param Family $model
     */
    public function __construct(Family $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
