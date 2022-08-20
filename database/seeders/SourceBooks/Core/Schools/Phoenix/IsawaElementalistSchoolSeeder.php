<?php

namespace Database\Seeders\SourceBooks\Core\Schools\Phoenix;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class IsawaElementalistSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Isawa Elementalist School',
            Family::query()->where('key', 'isawa')->first(['id']),
            ['shugenja'],
            Ring::query()->where('key', 'void')->first(['id']),
            Ring::query()->where('key', 'void')->first(['id']),
            3,
            (new StartingSkills())
                ->withKey('composition')
                ->withKey('courtesy')
                ->withKey('medicine')
                ->withKey('meditation')
                ->withKey('performance')
                ->withKey('theology'),
            40,
            ['invocations', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Invocations', 3, [
                    'extinguish',
                    'grasp_of_earth',
                    'path_to_inner_peace',
                    'tempest_of_air',
                ])
                ->withGroup('Rituals', [
                    'commune_with_the_spirits',
                    'divination',
                ]),
            'One with the Elements',
            (new StartingOutfit())
                ->withItem('sanctified_robes')
                ->withItem('wakizashi')
                ->withItem('knife')
                ->withItem('scroll_satchel')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('composition')
                    ->withSkill('command')
                    ->withSkill('medicine')
                    ->withTechniqueSubtype('fire_invocations', 1)
                    ->withTechnique('dance_of_seasons', true)
                    ->withTechnique('cleansing_rite'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('meditation')
                    ->withSkill('performance')
                    ->withTechniqueSubtype('water_invocations', 1, 2)
                    ->withTechnique('fury_of_osano_wo', true)
                    ->withTechnique('fanning_the_flames'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('composition')
                    ->withSkill('meditation')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('air_invocations', 1, 3)
                    ->withTechnique('wings_of_the_phoenix', true)
                    ->withTechnique('strike_the_tsunami'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('government')
                    ->withSkill('sentiment')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_invocations', 1, 4)
                    ->withTechnique('wrath_of_kaze_no_kami', true)
                    ->withTechnique('rise_flame'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('composition')
                    ->withSkill('sentiment')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('fire_invocations', 1, 5)
                    ->withTechnique('earthquake')
                    ->withTechnique('rouse_the_soul')),
            'Master of Elements',
        );
    }
}
