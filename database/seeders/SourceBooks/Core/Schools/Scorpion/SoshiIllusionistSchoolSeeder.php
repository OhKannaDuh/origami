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

final class SoshiIllusionistSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Soshi Illusionist School',
            Family::query()->where('key', 'soshi')->first(['id']),
            ['shugenja', 'courtier', 'shinobi'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            3,
            (new StartingSkills())
                ->withKey('courtesy')
                ->withKey('fitness')
                ->withKey('games')
                ->withKey('performance')
                ->withKey('skulduggery')
                ->withKey('theology'),
            30,
            ['invocations', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Invocations', 3, [
                    'bo_of_water',
                    'cloak_of_night',
                    'natures_touch',
                    'token_of_memory',
                ])
                ->withGroup('Rituals', [
                    'commune_with_the_spirits',
                ])
                ->withGroup('Shuji', [
                    'all_in_jest',
                ]),
            'The Kami\'s Whisper',
            (new StartingOutfit())
                ->withItem('sanctified_robes')
                ->withItem('inconspicuous_garb')
                ->withItem('wakizashi')
                ->withItem('knife')
                ->withItem('scroll_satchel')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('courtesy')
                    ->withSkill('fitness')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('air_invocations', 1)
                    ->withTechnique('mask_of_wind', true)
                    ->withTechnique('skulk', true))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('medicine')
                    ->withSkill('sentiment')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('water_invocations', 1, 2)
                    ->withTechnique('vapor_of_nightmares', true)
                    ->withTechnique('lord_bayushis_whispers'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('games')
                    ->withSkill('courtesy')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('air_invocations', 1, 3)
                    ->withTechnique('false_realm_of_the_fox_spirits', true)
                    ->withTechnique('noxious_cloud', true))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('performance')
                    ->withSkill('sentiment')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_invocations', 1, 4)
                    ->withTechnique('deadly_sting', true)
                    ->withTechnique('rise_air'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('fitness')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('air_invocations', 1, 5)
                    ->withTechnique('buoyant_arrival')
                    ->withTechnique('silencing_stroke')),
            'World of Shadows',
        );
    }
}
