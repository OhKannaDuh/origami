<?php

namespace App\Repositories\Character;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Character\Technique;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<Technique>
 */
final class TechniqueRepository extends BaseRepository implements TechniqueRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param Technique $model
     */
    public function __construct(Technique $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
