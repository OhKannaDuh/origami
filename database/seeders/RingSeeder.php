<?php

namespace Database\Seeders;

use App\Repositories\Core\RingRepositoryInterface;
use Illuminate\Database\Seeder;

final class RingSeeder extends Seeder
{


    public function run(RingRepositoryInterface $rings): void
    {
        $rings->createMany([
            [
                'key' => 'air',
                'name' => 'Air',
            ],
            [
                'key' => 'earth',
                'name' => 'Earth',
            ],
            [
                'key' => 'fire',
                'name' => 'Fire',
            ],
            [
                'key' => 'water',
                'name' => 'Water',
            ],
            [
                'key' => 'void',
                'name' => 'Void',
            ],
        ]);
    }
}
