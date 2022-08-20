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

final class YasukiMerchantSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Yasuki Merchant School',
            Family::query()->where('key', 'yasuki')->first(['id']),
            ['courtier'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'earth')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('commerce')
                ->withKey('composition')
                ->withKey('courtesy')
                ->withKey('culture')
                ->withKey('design')
                ->withKey('government')
                ->withKey('martial_arts_ranged'),
            40,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Shuji', [
                    'artisans_appraisal'
                ])
                ->withChoice('Shuji', 1, [
                    'rustling_of_leaves',
                    'well_of_desire',
                ]),
            'Way of the Carp',
            (new StartingOutfit())
                ->withItem('traveling_clothes')
                ->withItem('ceremonial_clothes')
                ->withItem('wakizashi')
                ->withItem('knife')
                ->withItem('yumi')
                ->withItem('quiver_of_arrows')
                ->withItem('calligraphy_set')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('command')
                    ->withSkill('design')
                    ->withSkill('government')
                    ->withTechniqueSubtype('earth_shuji', 1)
                    ->withTechnique('tributaries_of_trade', true)
                    ->withTechnique('all_in_jest'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('commerce')
                    ->withSkill('composition')
                    ->withSkill('culture')
                    ->withTechniqueSubtype('fire_shuji', 1, 2)
                    ->withTechnique('ebb_and_flow', true)
                    ->withTechnique('slippery_maneuvers'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('commerce')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('seafaring')
                    ->withTechniqueSubtype('air_shuji', 1, 3)
                    ->withTechnique('pillar_of_calm', true)
                    ->withTechnique('lord_hidas_grip'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('command')
                    ->withSkill('government')
                    ->withSkill('sentiment')
                    ->withTechniqueSubtype('water_shuji', 1, 4)
                    ->withTechnique('buoyant_arrival', true)
                    ->withTechnique('bravado'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('commerce')
                    ->withSkill('culture')
                    ->withSkill('design')
                    ->withTechniqueSubtype('void_shuji', 1, 5)
                    ->withTechnique('the_immovable_hand_of_peace')
                    ->withTechnique('lady_dojis_decree', true)),
            'Treasures of the Carp',
        );
    }
}
