<?php

namespace Database\Seeders\Core;

use App\Models\Core\SourceBook;
use App\Repositories\Core\SourceBookRepositoryInterface;
use Database\Seeders\Seeder;

final class SourceBookSeeder extends Seeder
{


    public function run(SourceBookRepositoryInterface $repository): void
    {
        $data = $this->getData(SourceBook::class);

        foreach ($data as $datum) {
            $repository->create($datum);
        }
    }
}
