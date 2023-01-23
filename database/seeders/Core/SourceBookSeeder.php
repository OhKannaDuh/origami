<?php

namespace Database\Seeders\Core;

use App\Models\Core\SourceBook;
use App\Repositories\Core\SourceBookRepositoryInterface;
use Database\Seeders\Seeder;

final class SourceBookSeeder extends Seeder
{


    public function run(SourceBookRepositoryInterface $repository): void
    {
        $this->createFrom(SourceBook::class, $repository);
    }
}
