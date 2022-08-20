<?php

namespace App\Repositories\Core;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Core\SkillGroup;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<SkillGroup>
 */
final class SkillGroupRepository extends BaseRepository implements SkillGroupRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param SkillGroup $model
     */
    public function __construct(SkillGroup $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [
            'key' => [
                'required',
                'string',
            ],
            'name' => [
                'required',
                'string',
            ],
            'description' => [
                'string',
            ],
        ];
    }
}
