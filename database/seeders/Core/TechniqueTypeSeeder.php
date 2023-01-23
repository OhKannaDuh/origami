<?php

namespace Database\Seeders\Core;

use App\Models\Core\TechniqueType;
use App\Repositories\Core\TechniqueTypeRepositoryInterface;
use Database\Seeders\Seeder;

final class TechniqueTypeSeeder extends Seeder
{


    public function run(TechniqueTypeRepositoryInterface $repository): void
    {
        $this->createFrom(TechniqueType::class, $repository);
    }
}
