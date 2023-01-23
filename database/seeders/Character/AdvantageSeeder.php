<?php

namespace Database\Seeders\Character;

use App\Models\Character\Advantage;
use App\Repositories\Character\AdvantageRepositoryInterface;
use App\Repositories\Core\AdvantageTypeRepositoryInterface;
use App\Repositories\Core\RingRepositoryInterface;
use App\Repositories\Core\SourceBookRepositoryInterface;
use Database\Seeders\Seeder;
use Illuminate\Support\Arr;

final class AdvantageSeeder extends Seeder
{


    public function run(
        AdvantageRepositoryInterface $repository,
        SourceBookRepositoryInterface $sourceBooks,
        AdvantageTypeRepositoryInterface $types,
        RingRepositoryInterface $rings,
    ): void {
        $data = $this->getData(Advantage::class);

        foreach ($data as $datum) {
            $sourceBook = $sourceBooks->getByKey($datum['source_book_key']);
            $type = $types->getByKey($datum['advantage_type_key']);
            $ring = $rings->getByKey($datum['ring_key']);

            $create = Arr::only($datum, ['key', 'name', 'page_number']);
            $create['source_book_id'] = $sourceBook->getKey();
            $create['advantage_type_id'] = $type->getKey();
            $create['ring_id'] = $ring->getKey();

            $repository->create($create);
        }
    }
}
