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

final class HirumaScoutSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Hiruma Scout School',
            Family::query()->where('key', 'hiruma')->first(['id']),
            ['bushi'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('fitness')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_ranged')
                ->withKey('skulduggery')
                ->withKey('survival')
                ->withKey('tactics')
                ->withKey('theology'),
            35,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Kata', 1, [
                    'pelting_hail_style',
                    'rushing_avalanche_style',
                ])
                ->withChoice('Kata', 1, [
                    'striking_as_air',
                    'striking_as_water',
                ]),
            'Flickering Flame Skirmisher',
            (new StartingOutfit())
                ->withItem('traveling_clothes')
                ->withItem('ashigaru_armor')
                ->withDaisho()
                ->withChoice([
                    'yari',
                    'yumi',
                ])
                ->withItem('quiver_of_arrows')
                ->withItem('knife')
                ->withTravelingPack()
                ->withItem('finger_of_jade'),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('medicine')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueType('kata', 1)
                    ->withTechnique('threshold_barrier')
                    ->withTechnique('slippery_maneuvers', true))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('smithing')
                    ->withTechniqueSubtype('water_shuji', 1, 2)
                    ->withTechnique('skulk', true)
                    ->withTechnique('lord_hidas_grip'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('skulduggery')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('deadly_sting', true)
                    ->withTechnique('touchstone_of_courage'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('air_shuji', 1, 4)
                    ->withTechnique('noxious_cloud', true)
                    ->withTechnique('crashing_wave_style'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('smithing')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1, 5)
                    ->withTechnique('rouse_the_soul')
                    ->withTechnique('silencing_stroke', true)),
            'Slayer\'s Slash',
        );
    }
}
