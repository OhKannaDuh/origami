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

final class ShosuroInfiltratorSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Shosuro Infiltrator School',
            Family::query()->where('key', 'shosuro')->first(['id']),
            ['shinobi', 'courtier'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'fire')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('courtesy')
                ->withKey('fitness')
                ->withKey('games')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_unarmed')
                ->withKey('performance')
                ->withKey('skulduggery'),
            30,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Ninjutsu', [
                    'deadly_sting',
                ])
                ->withChoice('Shuji', 1, [
                    'whispers_of_court',
                    'sensational_distraction',
                ]),
            'The Path of Shadoes',
            (new StartingOutfit())
                ->withItem('ceremonial_clothes')
                ->withItem('common_clothes')
                ->withItem('traveling_clothes')
                ->withDaisho()
                ->withItem('knife')
                ->withItem('yumi')
                ->withItem('quiver_of_arrows')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('courtesy')
                    ->withSkill('performance')
                    ->withSkill('skulduggery')
                    ->withTechniqueType('kata', 1)
                    ->withTechnique('veiled_menace_style', true)
                    ->withTechnique('skulk', true))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('fitness')
                    ->withSkill('performance')
                    ->withSkill('martial_arts_unarmed')
                    ->withTechniqueSubtype('air_shuji', 1, 2)
                    ->withTechnique('lord_bayushis_whispers')
                    ->withTechnique('noxious_cloud', true))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('sentiment')
                    ->withSkill('performance')
                    ->withSkill('skulduggery')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('bravado', true)
                    ->withTechnique('dazzling_performance'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('sentiment')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('air_shuji', 1, 4)
                    ->withTechnique('silencing_stroke', true)
                    ->withTechnique('a_samurais_fate'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('courtesy')
                    ->withSkill('performance')
                    ->withSkill('skulduggery')
                    ->withTechniqueType('kata', 1, 5)
                    ->withTechnique('buoyant_arrival')
                    ->withTechnique('sear_the_wound')),
            'The Final Silence',
        );
    }
}
