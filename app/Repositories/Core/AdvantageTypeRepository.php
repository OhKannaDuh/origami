<?php

namespace App\Repositories\Core;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Core\AdvantageType;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<AdvantageType>
 */
final class AdvantageTypeRepository extends BaseRepository implements AdvantageTypeRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param AdvantageType $model
     */
    public function __construct(AdvantageType $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
