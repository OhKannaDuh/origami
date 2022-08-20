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

final class UtakuBattleMaidenSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Utaku Battle Maiden School',
            Family::query()->where('key', 'utaku')->first(['id']),
            ['bushi'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'earth')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('fitness')
                ->withKey('government')
                ->withKey('martial_arts_melee')
                ->withKey('meditation')
                ->withKey('smithing')
                ->withKey('survival'),
            50,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Kata', 1, [
                    'crescent_moon_style',
                    'iron_forest_style',
                ])
                ->withGroup('Kata', [
                    'warriors_resolve'
                ]),
            'Heroic Charge',
            (new StartingOutfit())
                ->withItem('lacquered_armor')
                ->withItem('ceremonial_clothes')
                ->withDaisho()
                ->withItem('yari')
                ->withItem('yumi')
                ->withItem('quiver_of_arrows')
                ->withItem('knife')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('smithing')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1)
                    ->withTechnique('lady_shinjos_speed', true)
                    ->withTechnique('striking_as_air'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('earth_shuji', 1, 2)
                    ->withTechnique('thunderclap_strike', true)
                    ->withTechnique('rushing_avalanche_style'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('medicine')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('pillar_of_calm', true)
                    ->withTechnique('touchstone_of_courage'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_melee')
                    ->withTechniqueSubtype('air_shuji', 1, 4)
                    ->withTechnique('soul_sunder', true)
                    ->withTechnique('breath_of_wind_style'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('culture')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1, 5)
                    ->withTechnique('rouse_the_soul')
                    ->withTechnique('bend_with_the_storm')),
            '',
        );
    }
}
