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

final class IdeTraderSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Ide Trader School',
            Family::query()->where('key', 'ide')->first(['id']),
            ['courtier'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('commerce')
                ->withKey('courtesy')
                ->withKey('games')
                ->withKey('labor')
                ->withKey('martial_arts_ranged')
                ->withKey('medicine')
                ->withKey('survival'),
            45,
            ['kata', 'shuji', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Shuji', [
                    'tributaries_of_trade'
                ])
                ->withChoice('Shuji', 1, [
                    'cadence',
                    'shallow_waters',
                ]),
            'Vendor of Strange Wares',
            (new StartingOutfit())
                ->withItem('traveling_clothes')
                ->withItem('wakizashi')
                ->withItem('yumi')
                ->withItem('quiver_of_arrows')
                ->withItem('calligraphy_set')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('courtesy')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_ranged')
                    ->withTechniqueSubtype('air_shuji', 1)
                    ->withTechnique('feigned_opening', true)
                    ->withTechnique('hawks_precision'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('commerce')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('water_shuji', 1, 2)
                    ->withTechnique('ebb_and_flow', true)
                    ->withTechnique('lady_shinjos_speed'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('aesthetics')
                    ->withSkill('commerce')
                    ->withSkill('games')
                    ->withTechniqueSubtype('earth_shuji', 1, 3)
                    ->withTechnique('pillar_of_calm', true)
                    ->withTechnique('all_arts_are_one'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('aesthetics')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('sentiment')
                    ->withTechniqueSubtype('fire_shuji', 1, 4)
                    ->withTechnique('sear_the_wound', true)
                    ->withTechnique('regal_bearing'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('command')
                    ->withSkill('fitness')
                    ->withSkill('games')
                    ->withTechniqueSubtype('void_shuji', 1, 5)
                    ->withTechnique('bend_with_the_storm')
                    ->withTechnique('the_immovable_hand_of_peace')),
            'A friend in Every City',
        );
    }
}
