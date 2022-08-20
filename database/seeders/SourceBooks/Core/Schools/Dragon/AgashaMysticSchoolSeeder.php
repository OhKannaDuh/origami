<?php

namespace Database\Seeders\SourceBooks\Core\Schools\Dragon;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class AgashaMysticSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Agasha Mystic School',
            Family::query()->where('key', 'agasha')->first(['id']),
            ['shugenja'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            3,
            (new StartingSkills())
                ->withKey('fitness')
                ->withKey('martial_arts_unarmed')
                ->withKey('medicine')
                ->withKey('meditation')
                ->withKey('smithing')
                ->withKey('theology'),
            40,
            ['invocations', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Invocations', 1, [
                    'the_fires_from_within',
                    'tetsubo_of_earth',
                ])
                ->withGroup('Invocations', [
                    'path_to_inner_peace',
                    'jurojins_balm',
                ])
                ->withGroup('Rituals', [
                    'cleansing_rite',
                    'commune_with_the_spirits',
                ]),
            'Elemental Transmutation',
            (new StartingOutfit())
                ->withItem('sanctified_robes')
                ->withItem('wakizashi')
                ->withItem('bo')
                ->withItem('knife')
                ->withTravelingPack()
                ->withItem('scroll_satchel')
                ->withItem('set_of_glass_vials')
                ->withItem('journal'),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('fitness')
                    ->withSkill('medicine')
                    ->withSkill('smithing')
                    ->withTechniqueSubtype('earth_invocations', 1)
                    ->withTechnique('heart_of_the_water_dragon', true)
                    ->withTechnique('divination'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('fitness')
                    ->withSkill('medicine')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('water_invocations', 1, 2)
                    ->withTechnique('power_of_the_earth_dragon', true)
                    ->withTechnique('touch_the_void_dragon', true))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('medicine')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('fire_invocations', 1, 3)
                    ->withTechnique('rise_earth', true)
                    ->withTechnique('earth_becomes_sky'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('meditation')
                    ->withSkill('smithing')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('earth_invocations', 1, 4)
                    ->withTechnique('ever_changing_waves', true)
                    ->withTechnique('rise_water'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('medicine')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('water_invocations', 1, 5)
                    ->withTechnique('earthquake')
                    ->withTechnique('sear_the_wound')),
            'Experiment and Adapt',
        );
    }
}
