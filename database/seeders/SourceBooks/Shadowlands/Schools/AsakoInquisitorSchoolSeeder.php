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

final class AsakoInquisitorSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Asako Inquisitor School',
            $families->getByKey('asako'),
            ['courtier', 'shugenja'],
            $rings->getByKey('fire'),
            $rings->getByKey('void'),
            3,
            (new StartingSkills())
                ->withKey('courtesy')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_unarmed')
                ->withKey('meditation')
                ->withKey('performance')
                ->withKey('theology'),
            35,
            ['invocations', 'rituals'],
            (new StartingTechniques())
                ->withGroup('Rituals', [
                    'cleansing_rite',
                    'commune_with_the_spirits',
                    'divination',
                ])
                ->withGroup('Shuji', [
                    'cadence',
                    'truth_burns_through_lies',
                ]),
            'Traces of Passage',
            (new StartingOutfit())
                ->withItem('traveling_clothes')
                ->withItem('sanctified_robes')
                ->withDaisho()
                ->withItem('scroll_satchel')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('fire_invocations', 1, 1)
                    ->withTechnique('threshold_barrier')
                    ->withTechnique('weight_of_duty'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('government')
                    ->withSkill('meditation')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('air_invocations', 1, 2)
                    ->withTechnique('essence_of_jade', true)
                    ->withTechnique('open_hand_style', true))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('medicine')
                    ->withSkill('performance')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_invocations', 1, 3)
                    ->withTechnique('regal_bearing', true)
                    ->withTechnique('touchstone_of_courage'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('water_invocations', 1, 4)
                    ->withTechnique('the_souls_blade', true)
                    ->withTechnique('bravado'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('composition')
                    ->withSkill('skulduggery')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('fire_invocations', 1, 5)
                    ->withTechnique('striking_as_void', true)
                    ->withTechnique('rouse_the_soul')),
            'Resilient Readiness',
        );
    }
}
