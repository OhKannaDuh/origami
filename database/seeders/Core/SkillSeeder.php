<?php

namespace Database\Seeders\Core;

use App\Models\Core\Skill;
use App\Repositories\Core\SkillGroupRepositoryInterface;
use App\Repositories\Core\SkillRepositoryInterface;
use Database\Seeders\Seeder;
use Illuminate\Support\Arr;

final class SkillSeeder extends Seeder
{


    public function run(SkillRepositoryInterface $repository, SkillGroupRepositoryInterface $groups): void
    {
        $data = $this->getData(Skill::class);

        foreach ($data as $datum) {
            $group = $groups->getByKey($datum['skill_group']['key']);

            $create = Arr::only($datum, ['key', 'name', 'description']);
            $create['skill_group_id'] = $group->getKey();

            $repository->create($create);
        }
    }
}
