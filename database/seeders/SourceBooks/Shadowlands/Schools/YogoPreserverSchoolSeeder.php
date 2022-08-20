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

final class YogoPreserverSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Yogo Preserver School',
            $families->getByKey('yogo'),
            ['shugenja'],
            $rings->getByKey('fire'),
            $rings->getByKey('void'),
            3,
            (new StartingSkills())
                ->withKey('aesthetics')
                ->withKey('courtesy')
                ->withKey('martial_arts_melee')
                ->withKey('sentiment')
                ->withKey('skulduggery')
                ->withKey('theology'),
            38,
            ['invocations', 'rituals'],
            (new StartingTechniques())
                ->withGroup('Invocations', [
                    'by_the_light_of_the_lord_moon',
                    'embrace_of_kenro_ji_jin',
                    'yari_of_air',
                ])
                ->withGroup('Rituals', [
                    'craft_shikigami',
                    'threshold_barrier',
                ]),
            'Warded Shikigami',
            // Traveling clothes, sanctified robes, concealed armor, wakizashi, bo (staff), traveling pack
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('culture')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('fire_invocations', 1, 1)
                    ->withTechnique('cloak_of_night')
                    ->withTechnique('reflections_of_pan_ku'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('aesthetics')
                    ->withSkill('courtesy')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('air_invocations', 1, 2)
                    ->withTechnique('hands_of_the_tides', true)
                    ->withTechnique('skulk', true))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('government')
                    ->withSkill('smithing')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('fire_invocations', 1, 3)
                    ->withTechnique('vapor_of_nightmares')
                    ->withTechnique('wings_of_the_phoenix', true))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('performance')
                    ->withSkill('sentiment')
                    ->withTechniqueSubtype('air_invocations', 1, 4)
                    ->withTechnique('silencing_stroke')
                    ->withTechnique('suijins_embrace'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('culture')
                    ->withSkill('government')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('fire_invocations', 1, 5)
                    ->withTechnique('ever_changing_waves')
                    ->withTechnique('tomb_of_jade')),
            'Kingdom of Paper and Ink',
        );
    }
}
