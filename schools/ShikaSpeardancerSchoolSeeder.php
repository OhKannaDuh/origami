<?php

namespace Database\Seeders;

use App\Models\Core\SourceBook;
use App\Repositories\Character\FamilyRepositoryInterface;
use App\Repositories\Core\RingRepositoryInterface;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class ShikaSpeardancerSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Shika Speardancer School',
            $families->getByKey(''),
            ['bushi', 'shinobi'],
            $rings->getByKey('air'),
            $rings->getByKey('fire'),
            5,
            (new StartingSkills())
                ->withKey('martial_arts_melee')
                ->withKey('meditation')
                ->withKey('skulduggery')
                ->withKey('survival')
                ->withKey('fitness')
                ->withKey('sentiment')
                ->withKey('courtesy'),
            35,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Kata', [
                    'striking_as_air',
                    'striking_as_fire',
                ])
,

            'Typhoon in the Bamboo Grove',
            // Traveling clothes, stealth cloth- ing or ashigaru armor, yari or kamayari, wakizashi, traveling pack
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('games')
                    ->withSkill('skulduggery')
                    ->withSkill('survival')
                    ->withTechnique('like_a_ghost', true)
                    ->withTechnique('soaring_slice')
            )
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('courtesy')
                    ->withSkill('culture')
                    ->withSkill('martial_arts_melee')
                    ->withTechnique('to_float_or_sink', true)
                    ->withTechnique('crescent_moon_style')
            )
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('smithing')
                    ->withSkill('games')
                    ->withSkill('skulduggery')
                    ->withTechnique('slicing_wind_kick', true)
                    ->withTechnique('pole_vault')
            )
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('survival')
                    ->withTechnique('rouse_the_soul', true)
                    ->withTechnique('disappearing_world_style')
            )
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('government')
                    ->withSkill('sentiment')
                    ->withSkill('tactics')
                    ->withTechnique('silent_elimination', true)
                    ->withTechnique('the_ties_that_bind')
            )
,


            'The Lowest Bow',
        );

    }
}
