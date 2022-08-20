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

final class KitsuMediumSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Kitsu Medium School',
            Family::query()->where('key', 'kitsu')->first(['id']),
            ['shugenja'],
            Ring::query()->where('key', 'void')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            3,
            (new StartingSkills())
                ->withKey('courtesy')
                ->withKey('government')
                ->withKey('meditation')
                ->withKey('performance')
                ->withKey('survival')
                ->withKey('theology'),
            50,
            ['invocations', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Invocations', 2, [
                    'the_rushing_wave',
                    'path_to_inner_peace',
                    'biting_steel',
                ])
                ->withGroup('Rituals', [
                    'commune_with_the_spirits',
                    'cleansing_rite',
                ])
                ->withGroup('Shuji', [
                    'ancestry_unearthed',
                ]),
            'Favor of the Ancestors',
            (new StartingOutfit())
                ->withItem('sanctified_robes')
                ->withItem('traveling_clothes')
                ->withItem('wakizashi')
                ->withItem('knife')
                ->withItem('bo')
                ->withItem('scroll_satchel')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('medicine')
                    ->withSkill('performance')
                    ->withTechniqueSubtype('water_invocations', 1)
                    ->withTechnique('courage_of_seven_thunders')
                    ->withTechnique('heart_of_the_dragon', true))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('government')
                    ->withSkill('fitness')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('air_invocations', 1, 2)
                    ->withTechnique('hands_of_the_tides', true)
                    ->withTechnique('fanning_the_flames'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('government')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_invocations', 1, 3)
                    ->withTechnique('rise_earth', true)
                    ->withTechnique('ebb_and_flow'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('meditation')
                    ->withSkill('performance')
                    ->withTechniqueType('rituals', 1, 4)
                    ->withTechnique('wrath_of_kaze_no_kami', true)
                    ->withTechnique('bravado'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('government')
                    ->withSkill('sentiment')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('fire_invocations', 1, 5)
                    ->withTechnique('sear_the_wound')
                    ->withTechnique('buoyant_arrival')),
            'Strength of a Thousand Ancestors',
        );
    }
}
