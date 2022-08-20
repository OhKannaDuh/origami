<?php

namespace Database\Seeders\SourceBooks\Core\Schools\Crab;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class KuniPurifierSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Kuni Purifier School',
            Family::query()->where('key', 'kuni')->first(['id']),
            ['shugenja', 'bushi'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'fire')->first(['id']),
            3,
            (new StartingSkills())
                ->withKey('martial_arts_melee')
                ->withKey('medicine')
                ->withKey('sentiment')
                ->withKey('skulduggery')
                ->withKey('survival')
                ->withKey('theology'),
            35,
            ['invocations', 'kata', 'rituals'],
            (new StartingTechniques())
                ->withChoice('Kata', 1, [
                    'striking_as_earth',
                    'striking_as_fire',
                ])
                ->withGroup('Invocations', [
                    'armor_of_earth',
                    'jade_strike',
                ])
                ->withGroup('Rituals', [
                    'commune_with_the_spirits',
                    'threshold_barrier',
                ]),
            'Gaze into Shadow',
            (new StartingOutfit())
                ->withItem('sanctified_robes')
                ->withItem('wakizashi')
                ->withItem('knife')
                ->withItem('makeup_kit')
                ->withItem('scroll_satchel')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('skulduggery')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_invocations', 1)
                    ->withTechnique('bind_the_shadow', true)
                    ->withTechnique('biting_steel'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('performance')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('water_invocations', 1, 2)
                    ->withTechnique('crimson_leaves_strike', true)
                    ->withTechnique('symbol_of_earth'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('sentiment')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('fire_invocations', 1, 3)
                    ->withTechnique('rise_earth', true)
                    ->withTechnique('open_hand_style'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('medicine')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_invocations', 1, 4)
                    ->withTechnique('tomb_of_jade', true)
                    ->withTechnique('flowing_water_strike'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('government')
                    ->withSkill('theology')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('air_invocations', 1, 5)
                    ->withTechnique('earthquake')
                    ->withTechnique('soul_sunder')),
            'Purge the Wicked',
        );
    }
}
