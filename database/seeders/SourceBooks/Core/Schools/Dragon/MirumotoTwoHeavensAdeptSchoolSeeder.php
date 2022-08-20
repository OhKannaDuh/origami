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

final class MirumotoTwoHeavensAdeptSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Mirumoto Two-Heavens Adept School',
            Family::query()->where('key', 'mirumoto')->first(['id']),
            ['bushi'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'fire')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('composition')
                ->withKey('fitness')
                ->withKey('martial_arts_melee')
                ->withKey('medicine')
                ->withKey('tactics')
                ->withKey('theology'),
            50,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Kata', 1, [
                    'striking_as_fire',
                    'striking_as_water',
                    'striking_as_earth',
                ]),
            'Way of the Dragon',
            (new StartingOutfit())
                ->withItem('traveling_clothes')
                ->withItem('ceremonial_clothes')
                ->withItem('ashigaru_armor')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('composition')
                    ->withSkill('labor')
                    ->withSkill('medicine')
                    ->withTechniqueType('kata', 1)
                    ->withTechnique('iaijutsu_cut_rising_blade', true)
                    ->withTechnique('stirring_the_embers'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('command')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('meditation')
                    ->withTechniqueType('kata', 1, 2)
                    ->withTechnique('heartpiercing_strike', true)
                    ->withTechnique('slippery_maneuvers'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('composition')
                    ->withSkill('smithing')
                    ->withSkill('theology')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('pillar_of_calm', true)
                    ->withTechnique('commune_with_the_spirits'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('medicine')
                    ->withTechniqueSubtype('earth_shuji', 1, 4)
                    ->withTechnique('striking_as_void', true)
                    ->withTechnique('crashing_wave_style'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('composition')
                    ->withSkill('medicine')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1, 5)
                    ->withTechnique('sear_the_wound')
                    ->withTechnique('rouse_the_soul')),
            'Heart of the Dragon',
        );
    }
}
