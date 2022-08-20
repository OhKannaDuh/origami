<?php

namespace Database\Seeders\SourceBooks\Core\Schools\Unicorn;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class ShinjoOutriderSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Shinjo Outrider School',
            Family::query()->where('key', 'shinjo')->first(['id']),
            ['bushi', 'courtier'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'fire')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('commerce')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_ranged')
                ->withKey('medicine')
                ->withKey('skulduggery')
                ->withKey('survival')
                ->withKey('tactics'),
            40,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Kata', 1, [
                    'striking_as_fire',
                    'striking_as_water',
                ])
                ->withGroup('Kata', [
                    'lady_shinjos_speed'
                ]),
            'Born in the Saddle',
            (new StartingOutfit())
                ->withItem('ashigaru_armor')
                ->withItem('traveling_clothes')
                ->withDaisho()
                ->withItem('yumi')
                ->withItem('quiver_of_arrows')
                ->withItem('knife')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('commerce')
                    ->withSkill('courtesy')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('earth_shuji', 1)
                    ->withTechnique('pelting_hail_style', true)
                    ->withTechnique('cadence'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('courtesy')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('martial_arts_ranged')
                    ->withTechniqueType('kata', 1, 2)
                    ->withTechnique('flowing_water_strike', true)
                    ->withTechnique('dazzling_performance', true))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('performance')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('water_shuji', 1, 3)
                    ->withTechnique('crashing_wave_style', true)
                    ->withTechnique('crimson_leaves_strike'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('skulduggery')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1, 4)
                    ->withTechnique('bend_with_the_storm', true)
                    ->withTechnique('bravado'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('government')
                    ->withSkill('meditation')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('fire_shuji', 1, 5)
                    ->withTechnique('pin_the_fan')
                    ->withTechnique('rouse_the_soul')),
            'I Will Always Return',
        );
    }
}
