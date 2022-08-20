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

final class IuchiMeishodoMasterSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Iuchi Meishodo Master School',
            Family::query()->where('key', 'iuchi')->first(['id']),
            ['shugenja', 'artisan'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            3,
            (new StartingSkills())
                ->withKey('aesthetics')
                ->withKey('design')
                ->withKey('martial_arts_melee')
                ->withKey('meditation')
                ->withKey('survival')
                ->withKey('theology'),
            40,
            ['invocations', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Invocations', 2, [
                    'grasp_of_earth',
                    'jurojins_balm',
                    'the_rushing_wave',
                ])
                ->withGroup('Rituals', [
                    'commune_with_the_spirits'
                ])
                ->withChoice('Shuji', 1, [
                    'ancestry_unearthed',
                    'well_of_desire',
                ]),
            'The Way of Names',
            (new StartingOutfit())
                ->withItem('traveling_clothes')
                ->withItem('ceremonial_clothes')
                ->withItem('wakizashi')
                ->withItem('calligraphy_set')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('design')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('water_invocations', 1)
                    ->withTechnique('sympathetic_energies', true)
                    ->withTechnique('cleansing_rite'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('design')
                    ->withSkill('theology')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('earth_invocations', 1, 2)
                    ->withTechnique('hands_of_the_tides', true)
                    ->withTechnique('artisans_appraisal'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('performance')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueType('rituals', 1, 3)
                    ->withTechnique('rise_earth', true)
                    ->withTechnique('dazzling_performance'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('medicine')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('air_invocations', 1, 4)
                    ->withTechnique('rouse_the_soul', true)
                    ->withTechnique('a_samurais_fate'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('culture')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_shuji', 1, 5)
                    ->withTechnique('the_souls_blade')
                    ->withTechnique('ever_changing_waves')),
            'The Spirits Unbound',
        );
    }
}
