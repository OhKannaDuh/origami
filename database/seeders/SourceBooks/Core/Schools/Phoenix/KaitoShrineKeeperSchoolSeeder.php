<?php

namespace Database\Seeders\SourceBooks\Core\Schools\Phoenix;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class KaitoShrineKeeperSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Kaito Shrine Keeper School',
            Family::query()->where('key', 'kaito')->first(['id']),
            ['monk'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            4,
            (new StartingSkills())
                ->withKey('fitness')
                ->withKey('martial_arts_ranged')
                ->withKey('meditation')
                ->withKey('performance')
                ->withKey('smithing')
                ->withKey('theology'),
            45,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Kata', [
                    'hawks_precision'
                ])
                ->withGroup('Invocations', [
                    'tempest_of_air',
                ])
                ->withChoice('Rituals', 2, [
                    'cleansing_rite',
                    'commune_with_the_spirits',
                    'threshold_barrier',
                ]),
            'Sacred Arrows',
            (new StartingOutfit())
                ->withItem('sanctified_robes')
                ->withItem('wakizashi')
                ->withItem('yumi')
                ->withItem('quiver_of_arrows')
                ->withItem('bo')
                ->withItem('knife')
                ->withItem('scroll_satchel')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('air_invocations', 1, 1, true)
                    ->withTechnique('bind_the_shadow', true)
                    ->withTechnique('striking_as_air'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('performance')
                    ->withSkill('theology')
                    ->withSkill('smithing')
                    ->withTechniqueType('kata', 1, 2)
                    ->withTechnique('grasp_of_the_air_dragon', true)
                    ->withTechnique('divination'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('labor')
                    ->withSkill('medicine')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('water_invocations', 1, 3, true)
                    ->withTechnique('breath_of_wind_style', true)
                    ->withTechnique('flowing_water_strike'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('meditation')
                    ->withTechniqueType('kata', 1, 4)
                    ->withTechnique('rise_air', true)
                    ->withTechnique('soul_sunder', true))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('sentiment')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('fire_invocations', 1, 5, true)
                    ->withTechnique('tomb_of_jade', true)
                    ->withTechnique('pin_the_fan')),
            'Demon, Begone!',
        );
    }
}
