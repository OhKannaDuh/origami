<?php

namespace Database\Seeders\Core;

use App\Models\Core\SchoolType;
use App\Repositories\Core\SchoolTypeRepositoryInterface;
use Database\Seeders\Seeder;

final class SchoolTypeSeeder extends Seeder
{


    public function run(SchoolTypeRepositoryInterface $repository): void
    {
        $this->createFrom(SchoolType::class, $repository);
    }
}
