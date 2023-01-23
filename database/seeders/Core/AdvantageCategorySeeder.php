<?php

namespace Database\Seeders\Core;

use App\Models\Core\AdvantageCategory;
use App\Repositories\Core\AdvantageCategoryRepositoryInterface;
use Database\Seeders\Seeder;

final class AdvantageCategorySeeder extends Seeder
{


    public function run(AdvantageCategoryRepositoryInterface $repository): void
    {
        $this->createFrom(AdvantageCategory::class, $repository);
    }
}
