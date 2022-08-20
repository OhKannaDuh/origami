<?php

namespace Database\Seeders\SourceBooks\Core\Schools\Lion;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class IkomaBardSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Ikoma Bard School',
            Family::query()->where('key', 'ikoma')->first(['id']),
            ['courtier'],
            Ring::query()->where('key', 'fire')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('composition')
                ->withKey('courtesy')
                ->withKey('culture')
                ->withKey('martial_arts_ranged')
                ->withKey('performance')
                ->withKey('sentiment')
                ->withKey('tactics'),
            45,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Kata', [
                    'warriors_resolve'
                ])
                ->withGroup('Shuji', [
                    'fanning_the_flames',
                    'tributaries_of_trade',
                ]),
            'Heart of the Lion',
            (new StartingOutfit())
                ->withItem('traveling_clothes')
                ->withItem('wakizashi')
                ->withChoice([
                    'yari',
                    'tessen',
                ])
                ->withItem('yumi')
                ->withItem('quiver_of_arrows')
                ->withTravelingPack()
                ->withItem('journal'),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('composition')
                    ->withSkill('culture')
                    ->withSkill('martial_arts_melee')
                    ->withTechniqueSubtype('fire_shuji', 1)
                    ->withTechnique('slippery_maneuvers', true)
                    ->withTechnique('soaring_slice'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('performance')
                    ->withSkill('sentiment')
                    ->withTechniqueSubtype('water_shuji', 1, 2)
                    ->withTechnique('dazzling_performance', true)
                    ->withTechnique('spinning_blades_style'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('composition')
                    ->withSkill('performance')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('earth_shuji', 1, 3)
                    ->withTechnique('rallying_cry')
                    ->withTechnique('regal_bearing', true))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('government')
                    ->withSkill('sentiment')
                    ->withSkill('martial_arts_ranged')
                    ->withTechniqueSubtype('air_shuji', 1, 4)
                    ->withTechnique('sear_the_wound', true)
                    ->withTechnique('pillar_of_calm'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('performance')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('void_shuji', 1, 5)
                    ->withTechnique('bend_with_the_storm')
                    ->withTechnique('buoyant_arrival')),
            '',
        );
    }
}
