<?php

namespace App\Repositories\Core;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Core\SchoolType;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<SchoolType>
 */
final class SchoolTypeRepository extends BaseRepository implements SchoolTypeRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param SchoolType $model
     */
    public function __construct(SchoolType $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
