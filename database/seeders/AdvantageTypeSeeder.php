<?php

namespace Database\Seeders;

use App\Repositories\Core\AdvantageTypeRepositoryInterface;
use Illuminate\Database\Seeder;

final class AdvantageTypeSeeder extends Seeder
{


    public function run(AdvantageTypeRepositoryInterface $advantageTypes): void
    {
        $advantageTypes->createMany([
            [
                'key' => 'distinction',
                'name' => 'Distinction',
            ],
            [
                'key' => 'passion',
                'name' => 'Passion',
            ],
        ]);
    }
}
