<?php

namespace Database\Seeders\SourceBooks\EmeraldEmpire\Schools;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use App\Models\Core\SourceBook;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class MiyaCartographerSchoolSeeder extends SchoolSeeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Miya Cartographer School',
            Family::query()->where('key', 'miya')->first(['id']),
            ['artisan', 'courtier'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'earth')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('aesthetics')
                ->withKey('composition')
                ->withKey('culture')
                ->withKey('fitness')
                ->withKey('government')
                ->withKey('seafaring')
                ->withKey('survival'),
            50,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Kata', 1, [
                    'striking_as_earth',
                    'warriors_resolve',
                ])
                ->withChoice('Shuji', 1, [
                    'artisans_appraisal',
                    'civility_foremost',
                ]),
            'Well Traveled',
            (new StartingOutfit())
                ->withItem('traveling_clothes')
                ->withItem('wakizashi')
                ->withItem('yumi')
                ->withItem('quiver_of_arrows')
                ->withItem('knife')
                ->withItem('calligraphy_set')
                ->withTravelingPack()
                ->withItem('personal_seal_or_chop'),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('culture')
                    ->withSkill('fitness')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('earth_shuji', 1, 1)
                    ->withTechnique('slippery_maneuvers', true)
                    ->withTechnique('threshold_barrier'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('games')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1, 2)
                    ->withTechnique('the_wind_blows_both_ways', true)
                    ->withTechnique('feigned_opening'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('courtesy')
                    ->withSkill('culture')
                    ->withSkill('martial_arts_ranged')
                    ->withTechniqueSubtype('air_shuji', 1, 3)
                    ->withTechnique('crimson_leaves_strike', true)
                    ->withTechnique('all_arts_are_one'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('meditation')
                    ->withTechniqueType('kata', 1, 4)
                    ->withTechnique('bend_with_the_storm', true)
                    ->withTechnique('regal_bearing'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('command')
                    ->withSkill('culture')
                    ->withSkill('seafaring')
                    ->withTechniqueSubtype('earth_shuji', 1, 5)
                    ->withTechnique('awe_of_heaven')
                    ->withTechnique('bravado')),
            'Emerald Explorer',
        );
    }
}
