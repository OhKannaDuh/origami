<?php

namespace Database\Seeders;

use App\Models\Core\SkillGroup;
use App\Repositories\Core\SkillGroupRepositoryInterface;
use Illuminate\Database\Seeder;

final class SkillGroupSeeder extends Seeder
{


    public function run(SkillGroupRepositoryInterface $skillGroups): void
    {
        $skillGroups->createMany([
            [
                'key' => 'artisan',
                'name' => 'Artisan',
            ],
            [
                'key' => 'martial',
                'name' => 'Martial',
            ],
            [
                'key' => 'scholar',
                'name' => 'Scholar',
            ],
            [
                'key' => 'social',
                'name' => 'Social',
            ],
            [
                'key' => 'trade',
                'name' => 'Trade',
            ],
        ]);
    }
}
