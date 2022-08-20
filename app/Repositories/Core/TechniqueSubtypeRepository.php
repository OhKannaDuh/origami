<?php

namespace App\Repositories\Core;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Core\TechniqueSubtype;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<TechniqueSubtype>
 */
final class TechniqueSubtypeRepository extends BaseRepository implements TechniqueSubtypeRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param TechniqueSubtype $model
     */
    public function __construct(TechniqueSubtype $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
