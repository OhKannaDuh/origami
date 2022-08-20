<?php

namespace Database\Seeders\SourceBooks\Core\Schools\Scorpion;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class BayushiManipulatorSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Bayushi Manipulator School',
            Family::query()->where('key', 'bayushi')->first(['id']),
            ['courtier'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'fire')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('courtesy')
                ->withKey('design')
                ->withKey('martial_arts_unarmed')
                ->withKey('performance')
                ->withKey('sentiment')
                ->withKey('skulduggery'),
            35,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Shuji', [
                    'lord_bayushis_whispers'
                ])
                ->withChoice('Shuji', 1, [
                    'cadence',
                    'rustling_of_leaves',
                ]),
            'Weakness is My Strength',
            (new StartingOutfit())
                ->withItem('ceremonial_clothes')
                ->withItem('common_clothes')
                ->withItem('traveling_clothes')
                ->withItem('wakizashi')
                ->withItem('calligraphy_set')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('sentiment')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('air_shuji', 1)
                    ->withTechnique('fanning_the_flames', true)
                    ->withTechnique('weight_of_duty'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('skulduggery')
                    ->withSkill('martial_arts_melee')
                    ->withTechniqueSubtype('fire_shuji', 1, 2)
                    ->withTechnique('dazzling_performance', true)
                    ->withTechnique('veiled_menace_style'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('courtesy')
                    ->withSkill('culture')
                    ->withSkill('sentiment')
                    ->withTechniqueSubtype('water_shuji', 1, 3)
                    ->withTechnique('wolfs_proposal', true)
                    ->withTechnique('skulk', true))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('aesthetics')
                    ->withSkill('sentiment')
                    ->withSkill('medicine')
                    ->withTechniqueSubtype('earth_shuji', 1, 4)
                    ->withTechnique('buoyant_arrival', true)
                    ->withTechnique('deadly_sting'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('performance')
                    ->withSkill('martial_arts_ranged')
                    ->withTechniqueSubtype('void_shuji', 1, 5)
                    ->withTechnique('bend_with_the_storm')
                    ->withTechnique('sear_the_wound')),
            'Little Truths',
        );
    }
}
