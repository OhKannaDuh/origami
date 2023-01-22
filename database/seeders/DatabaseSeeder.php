<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{


    public function run(): void
    {
        $this->call([
            Core\SourceBookSeeder::class,
            Core\RingSeeder::class,
            Character\ItemTypeSeeder::class,
            Character\ItemSubtypeSeeder::class,
            Character\ItemSeeder::class,
        ]);
    }
}
