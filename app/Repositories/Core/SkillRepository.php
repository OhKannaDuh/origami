<?php

namespace App\Repositories\Core;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Core\Skill;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<Skill>
 */
final class SkillRepository extends BaseRepository implements SkillRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param Skill $model
     */
    public function __construct(Skill $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
