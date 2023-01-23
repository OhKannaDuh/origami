<?php

namespace Database\Seeders\Core;

use App\Models\Core\SkillGroup;
use App\Repositories\Core\SkillGroupRepositoryInterface;
use Database\Seeders\Seeder;

final class SkillGroupSeeder extends Seeder
{


    public function run(SkillGroupRepositoryInterface $repository): void
    {
        $this->createFrom(SkillGroup::class, $repository);
    }
}
