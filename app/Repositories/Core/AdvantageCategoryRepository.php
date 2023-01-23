<?php

namespace App\Repositories\Core;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Core\AdvantageCategory;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<AdvantageCategory>
 */
final class AdvantageCategoryRepository extends BaseRepository implements AdvantageCategoryRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param AdvantageCategory $model
     */
    public function __construct(AdvantageCategory $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
