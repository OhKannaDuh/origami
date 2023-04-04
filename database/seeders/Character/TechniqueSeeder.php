<?php

namespace Database\Seeders\Character;

use App\Models\Character\Technique;
use App\Repositories\Character\TechniqueRepositoryInterface;
use App\Repositories\Core\SourceBookRepositoryInterface;
use App\Repositories\Core\TechniqueSubtypeRepositoryInterface;
use Database\Seeders\Seeder;
use Illuminate\Support\Arr;

final class TechniqueSeeder extends Seeder
{


    public function run(
        TechniqueRepositoryInterface $repository,
        SourceBookRepositoryInterface $sourceBooks,
        TechniqueSubtypeRepositoryInterface $subtypes,
    ): void {
        $data = $this->getData(Technique::class);

        foreach ($data as $datum) {
            $sourceBook = $sourceBooks->getByKey($datum['source_book']['key']);
            $subtype = $subtypes->getByKey($datum['technique_subtype']['key']);

            $create = Arr::only($datum, ['key', 'name', 'rank', 'description', 'page_number']);
            $create['source_book_id'] = $sourceBook->getKey();
            $create['technique_subtype_id'] = $subtype->getKey();

            $repository->create($create);
        }
    }
}
