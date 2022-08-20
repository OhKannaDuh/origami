<?php

namespace Database\Seeders\SourceBooks\EmeraldEmpire\Schools;

use App\Models\Core\Ring;
use App\Models\Core\SourceBook;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class KitsuneImpersonatorTraditionSeeder extends SchoolSeeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Kitsune Impersonator Tradition',
            null,
            ['courtier', 'shugenja'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'fire')->first(['id']),
            3,
            (new StartingSkills())
                ->withKey('courtesy')
                ->withKey('games')
                ->withKey('performance')
                ->withKey('martial_arts_unarmed')
                ->withKey('survival')
                ->withKey('theology'),
            30,
            ['invocations', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Invocations', [
                    'natures_touch',
                    'token_of_memory',
                ])
                ->withGroup('Ritauls', [
                    'commune_with_the_spirits',
                ]),
            'Fox Spirit',
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('performance')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('air_invocations', 1, 1)
                    ->withTechnique('fanning_the_flames', true)
                    ->withTechnique('all_in_jest'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('skulduggery')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('air_shuji', 1, 2)
                    ->withTechnique('dazzling_performance', true)
                    ->withTechnique('false_realm_of_the_fox_spirits', true))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('culture')
                    ->withSkill('meditation')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('air_invocations', 1, 3)
                    ->withTechnique('crashing_wave_style', true)
                    ->withTechnique('regal_bearing', true))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('meditation')
                    ->withSkill('sentiment')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('air_shuji', 1, 4)
                    ->withTechnique('disappearing_world_style', true)
                    ->withTechnique('bravado'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('meditation')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('air_invocations', 1, 5)
                    ->withTechnique('soul_sunder', true)
                    ->withTechnique('buoyant_arrival')),
            'Ninth Tail Ascension',
        );
    }
}
