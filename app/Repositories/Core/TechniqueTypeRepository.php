<?php

namespace App\Repositories\Core;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Core\TechniqueType;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<TechniqueType>
 */
final class TechniqueTypeRepository extends BaseRepository implements TechniqueTypeRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param TechniqueType $model
     */
    public function __construct(TechniqueType $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
