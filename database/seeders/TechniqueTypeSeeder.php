<?php

namespace Database\Seeders;

use App\Repositories\Core\TechniqueTypeRepositoryInterface;
use Illuminate\Database\Seeder;

final class TechniqueTypeSeeder extends Seeder
{


    public function run(TechniqueTypeRepositoryInterface $techniqueTypes): void
    {
        $techniqueTypes->createMany([
            [
                'key' => 'kata',
                'name' => 'Kata',
            ],
            [
                'key' => 'kiho',
                'name' => 'Kihō',
            ],
            [
                'key' => 'invocations',
                'name' => 'Invocations',
            ],
            [
                'key' => 'rituals',
                'name' => 'Rituals',
            ],
            [
                'key' => 'shuji',
                'name' => 'Shūji',
            ],
            [
                'key' => 'maho',
                'name' => 'Mahō',
            ],
            [
                'key' => 'ninjutsu',
                'name' => 'Ninjutsu',
            ],
            [
                'key' => 'ability',
                'name' => 'Ability',
            ],
        ]);
    }
}
