<?php

namespace Database\Seeders\Character;

use App\Models\Core\ItemSubtype;
use App\Repositories\Core\ItemSubtypeRepositoryInterface;
use App\Repositories\Core\ItemTypeRepositoryInterface;
use Database\Seeders\Seeder;
use Illuminate\Support\Arr;

final class ItemSubtypeSeeder extends Seeder
{


    public function run(ItemSubtypeRepositoryInterface $repository, ItemTypeRepositoryInterface $types): void
    {
        $data = $this->getData(ItemSubtype::class);

        foreach ($data as $datum) {
            $type = $types->getByKey($datum['item_type']['key']);

            $create = Arr::only($datum, ['name', 'key']);
            $create['item_type_id'] = $type->getKey();

            $repository->create($create);
        }
    }
}
