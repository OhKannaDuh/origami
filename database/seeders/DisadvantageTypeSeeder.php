<?php

namespace Database\Seeders;

use App\Repositories\Core\DisadvantageTypeRepositoryInterface;
use Illuminate\Database\Seeder;

final class DisadvantageTypeSeeder extends Seeder
{


    public function run(DisadvantageTypeRepositoryInterface $disadvantageTypes): void
    {
        $disadvantageTypes->createMany([
            [
                'key' => 'adversity',
                'name' => 'Adversity',
            ],
            [
                'key' => 'anxiety',
                'name' => 'Anxiety',
            ],
        ]);
    }
}
