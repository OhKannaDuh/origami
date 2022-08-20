<?php

namespace App\Repositories\Core;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Core\Ring;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<Ring>
 */
final class RingRepository extends BaseRepository implements RingRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param Ring $model
     */
    public function __construct(Ring $model)
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
        ];
    }
}
