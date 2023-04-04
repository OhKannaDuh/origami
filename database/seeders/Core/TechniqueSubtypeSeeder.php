<?php

namespace Database\Seeders\Core;

use App\Models\Core\TechniqueSubtype;
use App\Repositories\Core\TechniqueSubtypeRepositoryInterface;
use App\Repositories\Core\TechniqueTypeRepositoryInterface;
use Database\Seeders\Seeder;
use Illuminate\Support\Arr;

final class TechniqueSubtypeSeeder extends Seeder
{


    public function run(TechniqueSubtypeRepositoryInterface $repository, TechniqueTypeRepositoryInterface $types): void
    {
        $data = $this->getData(TechniqueSubtype::class);

        foreach ($data as $datum) {
            $type = $types->getByKey($datum['technique_type']['key']);

            $create = Arr::only($datum, ['key', 'name']);
            $create['technique_type_id'] = $type->getKey();

            $repository->create($create);
        }
    }
}
