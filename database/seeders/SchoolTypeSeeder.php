<?php

namespace Database\Seeders;

use App\Repositories\Core\SchoolTypeRepositoryInterface;
use Illuminate\Database\Seeder;

final class SchoolTypeSeeder extends Seeder
{


    public function run(SchoolTypeRepositoryInterface $schoolTypes): void
    {

        $schoolTypes->createMany([
            [
                'key' => 'artisan',
                'name' => 'Artisan',
            ],
            [
                'key' => 'bushi',
                'name' => 'Bushi',
            ],
            [
                'key' => 'courtier',
                'name' => 'Courtier',
            ],
            [
                'key' => 'monk',
                'name' => 'Monk',
            ],
            [
                'key' => 'shinobi',
                'name' => 'Shinobi',
            ],
            [
                'key' => 'shugenja',
                'name' => 'Shugenja',
            ],
        ]);
    }
}
