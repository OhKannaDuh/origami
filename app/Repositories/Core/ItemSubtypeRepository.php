<?php

namespace App\Repositories\Core;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Core\ItemSubtype;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<ItemSubtype>
 */
final class ItemSubtypeRepository extends BaseRepository implements ItemSubtypeRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param ItemSubtype $model
     */
    public function __construct(ItemSubtype $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
