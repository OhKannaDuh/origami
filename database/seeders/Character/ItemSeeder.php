<?php

namespace Database\Seeders\Character;

use App\Models\Character\Item;
use App\Repositories\Character\ItemRepositoryInterface;
use App\Repositories\Core\ItemSubtypeRepositoryInterface;
use App\Repositories\Core\SourceBookRepositoryInterface;
use Database\Seeders\Seeder;
use Illuminate\Support\Arr;

final class ItemSeeder extends Seeder
{


    public function run(
        ItemRepositoryInterface $repository,
        SourceBookRepositoryInterface $sourceBooks,
        ItemSubtypeRepositoryInterface $subtypes,
    ): void {
        $data = $this->getData(Item::class);

        foreach ($data as $datum) {
            $sourceBook = $sourceBooks->getByKey($datum['source_book_key']);
            $subtype = $subtypes->getByKey($datum['item_subtype_key']);

            $create = Arr::only($datum, ['key', 'name', 'description', 'data', 'cost', 'rarity', 'page_number']);
            $create['source_book_id'] = $sourceBook->getKey();
            $create['item_subtype_id'] = $subtype->getKey();

            $repository->create($create);
        }
    }
}
