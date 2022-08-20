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

final class YogoWardmasterSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Yogo Wardmaster School',
            Family::query()->where('key', 'yogo')->first(['id']),
            ['shugenja'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            3,
            (new StartingSkills())
                ->withKey('composition')
                ->withKey('fitness')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_unarmed')
                ->withKey('medicine')
                ->withKey('theology'),
            40,
            ['invocations', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Invocations', 2, [
                    'jade_strike',
                    'grasp_of_earth',
                ])
                ->withGroup('Shuji', [
                    'shallow_waters'
                ])
                ->withGroup('Rituals', [
                    'commune_with_the_spirits',
                    'threshold_barrier',
                ]),
            'Mystical Script',
            (new StartingOutfit())
                ->withItem('sanctified_robes')
                ->withItem('concealed_armor')
                ->withItem('wakizashi')
                ->withChoice([
                    'bo',
                    'knife',
                ])
                ->withItem('calligraphy_set')
                ->withItem('scroll_satchel')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('composition')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('earth_invocations', 1)
                    ->withTechnique('civility_foremost', true)
                    ->withTechnique('path_to_inner_peace'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('composition')
                    ->withSkill('skulduggery')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('water_invocations', 1, 2)
                    ->withTechnique('ebb_and_flow', true)
                    ->withTechnique('embrace_of_kenro_ji_jin'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('performance')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('fire_invocations', 1, 3)
                    ->withTechnique('open_hand_style', true)
                    ->withTechnique('earth_becomes_sky'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('composition')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('air_invocations', 1, 4)
                    ->withTechnique('skulk', true)
                    ->withTechnique('rise_water'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('composition')
                    ->withSkill('performance')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_shuji', 1, 5)
                    ->withTechnique('deadly_sting', true)
                    ->withTechnique('tomb_of_jade')),
            'Bound in Ink',
        );
    }
}
