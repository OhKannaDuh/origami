<?php

namespace Database\Seeders;

use App\Repositories\Core\SkillGroupRepositoryInterface;
use App\Repositories\Core\SkillRepositoryInterface;
use Illuminate\Database\Seeder;

final class SkillSeeder extends Seeder
{


    public function run(
        SkillRepositoryInterface $skills,
        SkillGroupRepositoryInterface $skillGroups
    ): void {
        $skills->createMany([
            [
                'skill_group_id' => $skillGroups->getByKey('artisan')->getKey(),
                'key' => 'aesthetics',
                'name' => 'Aesthetics',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('artisan')->getKey(),
                'key' => 'composition',
                'name' => 'Composition',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('artisan')->getKey(),
                'key' => 'design',
                'name' => 'Design',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('artisan')->getKey(),
                'key' => 'smithing',
                'name' => 'Smithing',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('martial')->getKey(),
                'key' => 'fitness',
                'name' => 'Fitness',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('martial')->getKey(),
                'key' => 'martial_arts_melee',
                'name' => 'Martial Arts (Melee)',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('martial')->getKey(),
                'key' => 'martial_arts_ranged',
                'name' => 'Martial Arts (Ranged)',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('martial')->getKey(),
                'key' => 'martial_arts_unarmed',
                'name' => 'Martial Arts (Unarmed)',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('martial')->getKey(),
                'key' => 'meditation',
                'name' => 'Meditation',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('martial')->getKey(),
                'key' => 'tactics',
                'name' => 'Tactics',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('scholar')->getKey(),
                'key' => 'culture',
                'name' => 'Culture',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('scholar')->getKey(),
                'key' => 'government',
                'name' => 'Government',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('scholar')->getKey(),
                'key' => 'medicine',
                'name' => 'Medicine',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('scholar')->getKey(),
                'key' => 'sentiment',
                'name' => 'Sentiment',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('scholar')->getKey(),
                'key' => 'theology',
                'name' => 'Theology',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('social')->getKey(),
                'key' => 'command',
                'name' => 'Command',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('social')->getKey(),
                'key' => 'courtesy',
                'name' => 'Courtesy',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('social')->getKey(),
                'key' => 'games',
                'name' => 'Games',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('social')->getKey(),
                'key' => 'performance',
                'name' => 'Performance',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('trade')->getKey(),
                'key' => 'commerce',
                'name' => 'Commerce',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('trade')->getKey(),
                'key' => 'labor',
                'name' => 'Labor',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('trade')->getKey(),
                'key' => 'seafaring',
                'name' => 'Seafaring',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('trade')->getKey(),
                'key' => 'skulduggery',
                'name' => 'Skulduggery',
            ],
            [
                'skill_group_id' => $skillGroups->getByKey('trade')->getKey(),
                'key' => 'survival',
                'name' => 'Survival',
            ],
        ]);
    }
}
