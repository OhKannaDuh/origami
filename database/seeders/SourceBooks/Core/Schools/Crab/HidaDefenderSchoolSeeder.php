<?php

namespace Database\Seeders\SourceBooks\Core\Schools\Crab;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class HidaDefenderSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Hida Defender School',
            Family::query()->where('key', 'hida')->first(['id']),
            ['bushi'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('fitness')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_ranged')
                ->withKey('martial_arts_unarmed')
                ->withKey('meditation')
                ->withKey('survival')
                ->withKey('tactics'),
            40,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Kata', [
                    'lord_hidas_grip',
                ])
                ->withChoice('Kata', 1, [
                    'striking_as_earth',
                    'striking_as_water',
                ]),
            'Way of the Crab',
            (new StartingOutfit())
                ->withItem('lacquered_armor')
                ->withItem('traveling_clothes')
                ->withDaisho()
                ->withChoice([
                    'tetsubo',
                    'otsuchi',
                ])
                ->withItem('club')
                ->withItem('knife')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('medicine')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1)
                    ->withTechnique('rushing_avalanche_style', true)
                    ->withTechnique('honest_assessment'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('labor')
                    ->withSkill('theology')
                    ->withTechniqueType('kata', 1, 2)
                    ->withTechnique('touchstone_of_courage', true)
                    ->withTechnique('slippery_maneuvers'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('meditation')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('iron_in_the_mountains_style', true)
                    ->withTechnique('rallying_cry'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('meditation')
                    ->withTechniqueType('kata', 1, 4)
                    ->withTechnique('striking_as_void', true)
                    ->withTechnique('a_samurais_fate'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueType('kata', 1, 5)
                    ->withTechnique('rouse_the_soul')
                    ->withTechnique('the_immovable_hand_of_peace')),
            'The Mountain Does Not Fall',
        );
    }
}
