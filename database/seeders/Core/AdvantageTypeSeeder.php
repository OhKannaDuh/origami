<?php

namespace Database\Seeders\Core;

use App\Models\Core\AdvantageType;
use App\Repositories\Core\AdvantageTypeRepositoryInterface;
use Database\Seeders\Seeder;

final class AdvantageTypeSeeder extends Seeder
{


    public function run(AdvantageTypeRepositoryInterface $repository): void
    {
        $this->createFrom(AdvantageType::class, $repository);
    }
}
