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

final class ShibaGuardianSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Shiba Guardian School',
            Family::query()->where('key', 'shiba')->first(['id']),
            ['bushi', 'courtier'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('courtesy')
                ->withKey('fitness')
                ->withKey('martial_arts_melee')
                ->withKey('meditation')
                ->withKey('survival')
                ->withKey('tactics')
                ->withKey('theology'),
            45,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Kata', [
                    'lord_shibas_valor'
                ])
                ->withChoice('Kata', 1, [
                    'striking_as_earth',
                    'striking_as_water',
                ]),
            'Way of the Phoenix',
            (new StartingOutfit())
                ->withItem('ashigaru_armor')
                ->withItem('traveling_clothes')
                ->withDaisho()
                ->withChoice([
                    'naginata',
                    'yari',
                ])
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('courtesy')
                    ->withSkill('sentiment')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1)
                    ->withTechnique('civility_foremost', true)
                    ->withTechnique('stirring_the_embers'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('fitness')
                    ->withSkill('meditation')
                    ->withSkill('martial_arts_melee')
                    ->withTechniqueType('kata', 1, 2)
                    ->withTechnique('rallying_cry', true)
                    ->withTechnique('slippery_maneuvers'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('culture')
                    ->withSkill('meditation')
                    ->withSkill('martial_arts_melee')
                    ->withTechniqueSubtype('water_shuji', 1, 3)
                    ->withTechnique('a_samurais_fate', true)
                    ->withTechnique('touchstone_of_courage'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('tactics')
                    ->withTechniqueType('kata', 1, 4)
                    ->withTechnique('the_immovable_hand_of_peace', true)
                    ->withTechnique('touch_the_void_dragon', true))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('sentiment')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_shuji', 1, 5)
                    ->withTechnique('way_of_the_edgeless_sword', true)
                    ->withTechnique('rouse_the_soul')),
            'Stand of Honor',
        );
    }
}
