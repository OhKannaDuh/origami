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

final class IkomaShadowSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Ikoma Shadow School',
            $families->getByKey('ikoma'),
            ['courtier', 'shinobi'],
            $rings->getByKey('air'),
            $rings->getByKey('fire'),
            5,
            (new StartingSkills())
                ->withKey('courtesy')
                ->withKey('culture')
                ->withKey('government')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_ranged')
                ->withKey('skulduggery')
                ->withKey('survival'),
            40,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Shuji', [
                    'whispers_of_court',
                ])
                ->withGroup('Ninjutsu', [
                    'skulk',
                ])
                ->withChoice('Kata', 1, [
                    'hawks_precision',
                    'warriors_resolve',
                ]),
            'Victory before Honor',
            // Ashigaru armor or ceremonial clothes, daisho or wakizashi and kamayari, yumi, any one musi- cal instrument or book of poetry, traveling pack
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('performance')
                    ->withSkill('skulduggery')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('general_kata', 1, 1)
                    ->withTechnique('whats_yours_is_mine', true)
                    ->withTechnique('rustling_of_leaves'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('sentiment')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('fire_shuji', 1, 2)
                    ->withTechnique('crackling_laughter', true)
                    ->withTechnique('the_wind_blows_both_ways'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('commerce')
                    ->withSkill('labor')
                    ->withSkill('seafaring')
                    ->withTechniqueSubtype('water_shuji', 1, 3)
                    ->withTechnique('artful_alibi', true)
                    ->withTechnique('all_arts_are_one'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('skulduggery')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('general_kata', 1, 4)
                    ->withTechnique('deceitful_strike', true)
                    ->withTechnique('bravado'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('air_shuji', 1, 5)
                    ->withTechnique('silent_elimination', true)
                    ->withTechnique('pin_the_fan')),
            'Victory Is the Greatest Honor',
        );
    }
}
