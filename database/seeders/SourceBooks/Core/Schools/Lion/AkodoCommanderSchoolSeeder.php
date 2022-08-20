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

final class AkodoCommanderSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Akodo Commander School',
            Family::query()->where('key', 'akodo')->first(['id']),
            ['bushi'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('fitness')
                ->withKey('government')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_ranged')
                ->withKey('meditation')
                ->withKey('tactics'),
            50,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Kata', 1, [
                    'striking_as_earth',
                    'striking_as_water',
                ]),
            'Way of the Lion',
            (new StartingOutfit())
                ->withItem('ashigaru_armor')
                ->withItem('traveling_clothes')
                ->withDaisho()
                ->withItem('knife')
                ->withItem('knife')
                ->withItem('yumi')
                ->withItem('quiver_of_arrows')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('government')
                    ->withSkill('command')
                    ->withSkill('performance')
                    ->withTechniqueType('kata', 1)
                    ->withTechnique('iron_forest_style', true)
                    ->withTechnique('honest_assessment'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('medicine')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1, 2)
                    ->withTechnique('rallying_cry', true)
                    ->withTechnique('lightning_raid'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('government')
                    ->withSkill('composition')
                    ->withSkill('sentiment')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('a_samurais_fate', true)
                    ->withTechnique('touchstone_of_courage'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('government')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('fire_shuji', 1, 4)
                    ->withTechnique('rouse_the_soul', true)
                    ->withTechnique('disappearing_world_style'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('meditation')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('earth_shuji', 1, 5)
                    ->withTechnique('bend_with_the_storm')
                    ->withTechnique('striking_as_void')),
            'Akodo\'s Final Lesson',
        );
    }
}
