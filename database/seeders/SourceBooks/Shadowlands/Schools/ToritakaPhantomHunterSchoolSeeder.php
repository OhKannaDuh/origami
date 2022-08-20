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

final class ToritakaPhantomHunterSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Toritaka Phantom Hunter School',
            $families->getByKey('toritaka'),
            ['shugenja'],
            $rings->getByKey('air'),
            $rings->getByKey('water'),
            3,
            (new StartingSkills())
                ->withKey('culture')
                ->withKey('government')
                ->withKey('martial_arts_melee')
                ->withKey('sentiment')
                ->withKey('survival')
                ->withKey('theology'),
            40,
            ['invocations', 'rituals'],
            (new StartingTechniques())
                ->withGroup('Invocations', [
                    'by_the_light_of_the_lord_moon',
                ])
                ->withGroup('Rituals', [
                    'cleansing_rite',
                    'commune_with_the_spirits',
                    'tea_ceremony',
                ])
                ->withGroup('Shuji', [
                    'courtiers_resolve',
                ]),
            'Eyes of Yotogi',
            // Traveling clothes, sanctified robes, daisho (katana and wakizashi), scroll satchel, traveling pack
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('air_invocations', 1, 1)
                    ->withTechnique('bo_of_water')
                    ->withTechnique('threshold_barrier'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('culture')
                    ->withSkill('sentiment')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('water_shuji', 1, 2)
                    ->withTechnique('essence_of_jade', true)
                    ->withTechnique('striking_as_air'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('government')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('sentiment')
                    ->withTechniqueSubtype('water_invocations', 1, 3)
                    ->withTechnique('rise_water', true)
                    ->withTechnique('crescent_moon_style', true))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('performance')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('air_invocations', 1, 4)
                    ->withTechnique('rouse_the_soul', true)
                    ->withTechnique('soul_sunder', true))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('courtesy')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('air_shuji', 1, 5)
                    ->withTechnique('flowing_water_strike', true)
                    ->withTechnique('wrath_of_kaze_no_kami')),
            'Yotogi\'s Piercing Gaze',
        );
    }
}
