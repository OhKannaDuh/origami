<?php

namespace App\Repositories\Character;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Character\Item;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<Item>
 */
final class ItemRepository extends BaseRepository implements ItemRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param Item $model
     */
    public function __construct(Item $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
