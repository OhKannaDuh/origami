<?php

namespace Database\Seeders\SourceBooks\Core\Schools\Crane;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class DaidojiIronWarriorSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Daidoji Iron Warrior School',
            Family::query()->where('key', 'daidoji')->first(['id']),
            ['bushi'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('courtesy')
                ->withKey('culture')
                ->withKey('fitness')
                ->withKey('government')
                ->withKey('martial_arts_melee')
                ->withKey('tactics'),
            55,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Kata', [
                    'iron_forest_style'
                ])
                ->withChoice('Kata', 1, [
                    'striking_as_earth',
                    'striking_as_water',
                ]),
            'Vigilance of Mind',
            (new StartingOutfit())
                ->withItem('lacquered_armor')
                ->withItem('ceremonial_clothes')
                ->withDaisho()
                ->withChoice([
                    'yari',
                    'naginata',
                ])
                ->withItem('yumi')
                ->withItem('quiver_of_arrows')
                ->withItem('knife')
                ->withItem('calligraphy_set')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('courtesy')
                    ->withSkill('government')
                    ->withSkill('sentiment')
                    ->withTechniqueType('kata', 1)
                    ->withTechnique('crescent_moon_style', true)
                    ->withTechnique('stonewall_tactics'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('earth_shuji', 1, 2)
                    ->withTechnique('flowing_water_strike', true)
                    ->withTechnique('lady_dojis_decree'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('courtesy')
                    ->withSkill('sentiment')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('crashing_wave_style', true)
                    ->withTechnique('ebb_and_flow'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('air_shuji', 1, 4)
                    ->withTechnique('striking_as_void', true)
                    ->withTechnique('a_samurais_fate'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('aesthetics')
                    ->withSkill('culture')
                    ->withSkill('government')
                    ->withTechniqueType('kata', 1, 5)
                    ->withTechnique('the_immovable_hand_of_peace')
                    ->withTechnique('rouse_the_soul')),
            'To Tread the sword',
        );
    }
}
