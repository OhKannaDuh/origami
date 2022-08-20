<?php

namespace Database\Seeders\SourceBooks\Shadowlands\Schools;

use App\Models\Core\SourceBook;
use App\Repositories\Character\FamilyRepositoryInterface;
use App\Repositories\Core\RingRepositoryInterface;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class KitsuMedicSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Kitsu Medic School',
            $families->getByKey('kitsu'),
            ['artisan', 'bushi'],
            $rings->getByKey('earth'),
            $rings->getByKey('water'),
            5,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('fitness')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_unarmed')
                ->withKey('medicine')
                ->withKey('sentiment')
                ->withKey('survival'),
            44,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Kata', 1, [
                    'crescent_moon_style',
                    'striking_as_earth',
                    'striking_as_water',
                ])
                ->withChoice('Rituals', 1, [
                    'cleansing_rite',
                    'threshold_barrier',
                ])
                ->withGroup('Shuji', [
                    'stonewall_tactics',
                ]),
            'Field Medicine',
            // Traveling clothes, ashigaru armor, daisho (katana and wakizashi), satchel of medicinal supplies, traveling pack
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1, 1)
                    ->withTechnique('commune_with_the_spirits')
                    ->withTechnique('honest_assessment'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('medicine')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_shuji', 1, 2)
                    ->withTechnique('flowing_water_strike', true)
                    ->withTechnique('rushing_avalanche_style'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('medicine')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('iron_in_the_mountains_style', true)
                    ->withTechnique('touchstone_of_courage'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('fitness')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('water_shuji', 1, 5)
                    ->withTechnique('a_samurais_fate')
                    ->withTechnique('crashing_wave_style'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('courtesy')
                    ->withSkill('medicine')
                    ->withSkill('sentiment')
                    ->withTechniqueType('kata', 1, 5)
                    ->withTechnique('rouse_the_soul')
                    ->withTechnique('sear_the_wound')),
            'Healer\'s Hands',
        );
    }
}
