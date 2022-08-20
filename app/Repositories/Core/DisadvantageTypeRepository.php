<?php

namespace App\Repositories\Core;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Core\DisadvantageType;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<DisadvantageType>
 */
final class DisadvantageTypeRepository extends BaseRepository implements DisadvantageTypeRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param DisadvantageType $model
     */
    public function __construct(DisadvantageType $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
