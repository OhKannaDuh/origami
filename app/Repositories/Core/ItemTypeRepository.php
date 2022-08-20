<?php

namespace App\Repositories\Core;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Core\ItemType;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<ItemType>
 */
final class ItemTypeRepository extends BaseRepository implements ItemTypeRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param ItemType $model
     */
    public function __construct(ItemType $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
