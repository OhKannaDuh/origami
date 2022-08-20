<?php

namespace App\Repositories\Character;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Character\School;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<School>
 */
final class SchoolRepository extends BaseRepository implements SchoolRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param School $model
     */
    public function __construct(School $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
