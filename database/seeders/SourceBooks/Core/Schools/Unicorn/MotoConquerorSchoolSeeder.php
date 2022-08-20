<?php

namespace Database\Seeders\SourceBooks\Core\Schools\Unicorn;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class MotoConquerorSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Moto Conqueror School',
            Family::query()->where('key', 'moto')->first(['id']),
            ['bushi'],
            Ring::query()->where('key', 'fire')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('fitness')
                ->withKey('performance')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_unarmed')
                ->withKey('survival')
                ->withKey('tactics'),
            35,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Shuji', 1, [
                    'lightning_raid',
                    'slippery_maneuvers',
                ])
                ->withGroup('Shuji', [
                    'all_in_jest'
                ]),
            'Swirling Desert Wind',
            (new StartingOutfit())
                ->withItem('traveling_clothes')
                ->withItem('concealed_armor')
                ->withDaisho()
                ->withItem('yumi')
                ->withItem('quiver_of_arrows')
                ->withItem('knife')
                ->withItem('knife')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('performance')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1)
                    ->withTechnique('crescent_moon_style', true)
                    ->withTechnique('stirring_the_embers'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('performance')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('martial_arts_unarmed')
                    ->withTechniqueSubtype('fire_shuji', 1, 2)
                    ->withTechnique('heartpiercing_strike', true)
                    ->withTechnique('veiled_menace_style'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('tactics')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('bravado', true)
                    ->withTechnique('dazzling_performance'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('command')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('water_shuji', 1, 4)
                    ->withTechnique('striking_as_void', true)
                    ->withTechnique('crashing_wave_style'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('government')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1, 5)
                    ->withTechnique('sear_the_wound')
                    ->withTechnique('buoyant_arrival')),
            'Scouring Sirocco',
        );
    }
}
