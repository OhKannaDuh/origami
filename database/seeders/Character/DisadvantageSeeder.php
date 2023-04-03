<?php

namespace Database\Seeders\Character;

use App\Models\Character\Disadvantage;
use App\Repositories\Character\DisadvantageRepositoryInterface;
use App\Repositories\Core\DisadvantageTypeRepositoryInterface;
use App\Repositories\Core\RingRepositoryInterface;
use App\Repositories\Core\SourceBookRepositoryInterface;
use Database\Seeders\Seeder;
use Illuminate\Support\Arr;

final class DisadvantageSeeder extends Seeder
{


    public function run(
        DisadvantageRepositoryInterface $repository,
        SourceBookRepositoryInterface $sourceBooks,
        DisadvantageTypeRepositoryInterface $types,
        RingRepositoryInterface $rings,
    ): void {
        $data = $this->getData(Disadvantage::class);

        foreach ($data as $datum) {
            $sourceBook = $sourceBooks->getByKey($datum['source_book']['key']);
            $type = $types->getByKey($datum['disadvantage_type']['key']);
            $ring = $rings->getByKey($datum['ring']['key']);

            $create = Arr::only($datum, ['key', 'name', 'effects', 'page_number']);
            $create['source_book_id'] = $sourceBook->getKey();
            $create['disadvantage_type_id'] = $type->getKey();
            $create['ring_id'] = $ring->getKey();

            $repository->create($create);
        }
    }
}
