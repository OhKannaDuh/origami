<?php

namespace App\Repositories\Core;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Core\DisadvantageCategory;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<DisadvantageCategory>
 */
final class DisadvantageCategoryRepository extends BaseRepository implements DisadvantageCategoryRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param DisadvantageCategory $model
     */
    public function __construct(DisadvantageCategory $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
