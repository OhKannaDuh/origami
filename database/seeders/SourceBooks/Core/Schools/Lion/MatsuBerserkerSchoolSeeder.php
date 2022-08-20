<?php

namespace Database\Seeders\SourceBooks\Core\Schools\Lion;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class MatsuBerserkerSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Matsu Berserker School',
            Family::query()->where('key', 'matsu')->first(['id']),
            ['bushi'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'fire')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('fitness')
                ->withKey('labor')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_ranged')
                ->withKey('martial_arts_unarmed')
                ->withKey('survival'),
            55,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Kata', 1, [
                    'rushing_avalanche_style',
                    'spinning_blades_style',
                ])
                ->withGroup('Shuji', [
                    'stirring_the_embers',
                ]),
            'Matsu\'s Fury',
            (new StartingOutfit())
                ->withItem('ashigaru_armor')
                ->withItem('traveling_clothes')
                ->withDaisho()
                ->withChoice([
                    'nodachi',
                    'tessen',
                ])
                ->withItem('knife')
                ->withItem('yumi')
                ->withItem('quiver_of_arrows')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('labor')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1)
                    ->withTechnique('lord_akodos_roar', true)
                    ->withTechnique('stonewall_tactics'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('medicine')
                    ->withSkill('smithing')
                    ->withTechniqueType('kata', 1, 2)
                    ->withTechnique('heartpiercing_strike', true)
                    ->withTechnique('fanning_the_flames'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('composition')
                    ->withSkill('government')
                    ->withSkill('theology')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('disappearing_world_style', true)
                    ->withTechnique('rallying_cry'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('courtesy')
                    ->withSkill('culture')
                    ->withTechniqueType('kata', 1, 4)
                    ->withTechnique('striking_as_void', true)
                    ->withTechnique('bravado'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('labor')
                    ->withSkill('medicine')
                    ->withSkill('smithing')
                    ->withTechniqueType('kata', 1, 5)
                    ->withTechnique('rouse_the_soul')
                    ->withTechnique('sear_the_wound')),
            'Rending Jaws of the Lion',
        );
    }
}
