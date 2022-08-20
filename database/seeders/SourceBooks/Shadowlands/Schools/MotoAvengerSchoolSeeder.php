<?php

namespace Database\Seeders\SourceBooks\Shadowlands\Schools;

use App\Models\Core\SourceBook;
use App\Repositories\Character\FamilyRepositoryInterface;
use App\Repositories\Core\RingRepositoryInterface;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class MotoAvengerSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Moto Avenger School',
            $families->getByKey('moto'),
            ['shugenja'],
            $rings->getByKey('air'),
            $rings->getByKey('earth'),
            3,
            (new StartingSkills())
                ->withKey('courtesy')
                ->withKey('culture')
                ->withKey('martial_arts_melee')
                ->withKey('sentiment')
                ->withKey('survival')
                ->withKey('theology'),
            44,
            ['air_invocations', 'earth_invocations', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Invocations', [
                    'grasp_of_earth',
                    'tempest_of_air',
                ])
                ->withGroup('Shuji', [
                    'ancestry_unearthed',
                    'honest_assessment',
                ]),
            'Hands of Earth and Sky',
            // Traveling clothes, ashigaru armor, wakizashi, scroll satchel, finger of jade, traveling pack
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('survival')
                    ->withTechniqueType('rituals', 1, 1)
                    ->withTechnique('bind_the_shadow', true)
                    ->withTechnique('caress_of_earth'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('culture')
                    ->withSkill('medicine')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('air_invocations', 1, 2)
                    ->withTechnique('essence_of_jade', true)
                    ->withTechnique('touchstone_of_courage', true))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('courtesy')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('earth_shuji', 1, 3)
                    ->withTechnique('earthquake', true)
                    ->withTechnique('earth_becomes_sky'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('medicine')
                    ->withSkill('sentiment')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_invocations', 1, 4)
                    ->withTechnique('rise_air')
                    ->withTechnique('wolfs_proposal'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('performance')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('air_invocations', 1, 5)
                    ->withTechnique('rouse_the_soul')
                    ->withTechnique('tomb_of_jade')),
            'Empathic Transfer',
        );
    }
}
