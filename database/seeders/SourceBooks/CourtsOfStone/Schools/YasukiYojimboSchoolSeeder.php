<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Schools;

use App\Models\Core\SourceBook;
use App\Repositories\Character\FamilyRepositoryInterface;
use App\Repositories\Core\RingRepositoryInterface;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class YasukiYojimboSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Yasuki Yojimbo School',
            $families->getByKey('yasuki'),
            ['bushi'],
            $rings->getByKey('earth'),
            $rings->getByKey('water'),
            5,
            (new StartingSkills())
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_ranged')
                ->withKey('tactics')
                ->withKey('commerce')
                ->withKey('courtesy')
                ->withKey('seafaring')
                ->withKey('survival'),
            50,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Kata', [
                    'crescent_moon_style',
                ])
                ->withChoice('Shuji', 1, [
                    'honest_assessment',
                    'well_of_desire',
                ]),
            'Claws of the Crab',
            // Crossbow or spear, daisho, pony or ashigaru armor, traveling pack, map of Crab Lands, knife
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('commerce')
                    ->withSkill('government')
                    ->withSkill('seafaring')
                    ->withTechniqueSubtype('earth_shuji', 1, 1)
                    ->withTechnique('iron_forest_style', true)
                    ->withTechnique('trip_the_leg'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('courtesy')
                    ->withSkill('culture')
                    ->withSkill('government')
                    ->withTechniqueSubtype('water_shuji', 1, 2)
                    ->withTechnique('touchstone_of_courage', true)
                    ->withTechnique('unyielding_terms'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('courtesy')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('sentiment')
                    ->withTechniqueSubtype('ranged_combat_kata', 1, 3)
                    ->withTechnique('pillar_of_calm', true)
                    ->withTechnique('all_shall_fear_me'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('medicine')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('general_kata', 1, 4)
                    ->withTechnique('soul_sunder', true)
                    ->withTechnique('a_samurais_fate'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('seafaring')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('air_shuji', 1, 5)
                    ->withTechnique('rouse_the_soul')
                    ->withTechnique('striking_as_void')),
            'The Standing Death',
        );
    }
}
