<?php

namespace Database\Seeders\Core;

use App\Models\Core\DisadvantageCategory;
use App\Repositories\Core\DisadvantageCategoryRepositoryInterface;
use Database\Seeders\Seeder;

final class DisadvantageCategorySeeder extends Seeder
{


    public function run(DisadvantageCategoryRepositoryInterface $repository): void
    {
        $this->createFrom(DisadvantageCategory::class, $repository);
    }
}
