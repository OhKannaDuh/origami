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

final class KaiuEngineerSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Kaiu Engineer School',
            Family::query()->where('key', 'kaiu')->first(['id']),
            ['artisan', 'bushi'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'fire')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('design')
                ->withKey('labor')
                ->withKey('martial_arts_ranged')
                ->withKey('medicine')
                ->withKey('smithing')
                ->withKey('theology'),
            40,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Kata', [
                    'tactical_assessment'
                ])
                ->withGroup('Shuji', [
                    'stirring_the_embers',
                    'stonewall_tactics',
                ]),
            'Masterful Builder',
            (new StartingOutfit())
                ->withItem('traveling_clothes')
                ->withItem('ceremonial_clothes')
                ->withItem('ashigaru_armor')
                ->withDaisho()
                ->withItem('oyumi')
                ->withItem('quiver_of_bolts')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('smithing')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('earth_shuji', 1)
                    ->withTechnique('pelting_hail_style', true)
                    ->withTechnique('hawks_precision'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('medicine')
                    ->withSkill('smithing')
                    ->withTechniqueType('kata', 1, 2)
                    ->withTechnique('battle_in_the_mind', true)
                    ->withTechnique('noxious_cloud', true))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('government')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('smithing')
                    ->withTechniqueSubtype('water_shuji', 1, 3)
                    ->withTechnique('pillar_of_calm', true)
                    ->withTechnique('flowing_water_strike'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('command')
                    ->withSkill('labor')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('fire_shuji', 1, 4)
                    ->withTechnique('soul_sunder', true)
                    ->withTechnique('iron_in_the_mountains_style'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('smithing')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('earth_shuji', 1, 5)
                    ->withTechnique('sear_the_wound')
                    ->withTechnique('pin_the_fan')),
            'Ingenious Design',
        );
    }
}
