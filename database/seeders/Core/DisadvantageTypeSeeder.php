<?php

namespace Database\Seeders\Core;

use App\Models\Core\DisadvantageType;
use App\Repositories\Core\DisadvantageTypeRepositoryInterface;
use Database\Seeders\Seeder;

final class DisadvantageTypeSeeder extends Seeder
{


    public function run(DisadvantageTypeRepositoryInterface $repository): void
    {
        $this->createFrom(DisadvantageType::class, $repository);
    }
}
