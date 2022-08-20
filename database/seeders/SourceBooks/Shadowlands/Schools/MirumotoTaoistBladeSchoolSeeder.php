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

final class MirumotoTaoistBladeSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Mirumoto Taoist Blade School',
            $families->getByKey('mirumoto'),
            ['bushi', 'monk'],
            $rings->getByKey('void'),
            $rings->getByKey('water'),
            4,
            (new StartingSkills())
                ->withKey('labor')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_unarmed')
                ->withKey('meditation')
                ->withKey('survival')
                ->withKey('theology'),
            48,
            ['kata', 'kiho', 'rituals'],
            (new StartingTechniques())
                ->withChoice('Kata', 2, [
                    'iaijutsu_cut_rising_blade',
                    'soaring_slice',
                    'striking_as_water',
                ])
                ->withGroup('Kiho', [
                    'water_fist',
                ]),
            'Sharpened Ki',
            // Traveling clothes, daisho (any one sword of rarity 7 or lower and wakizashi), traveling pack
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('labor')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueType('kata', 1, 1)
                    ->withTechnique('crescent_moon_style', true)
                    ->withTechnique('ki_protection'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('water_kiho', 1, 2)
                    ->withTechnique('flowing_water_strike', true)
                    ->withTechnique('iaijutsu_cut_crossing_blade'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('medicine')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_kiho', 1, 3)
                    ->withTechnique('crimson_leaves_strike')
                    ->withTechnique('still_the_elements'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('composition')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('void_kiho', 1, 4)
                    ->withTechnique('striking_as_void', true)
                    ->withTechnique('crashing_wave_style'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('labor')
                    ->withSkill('sentiment')
                    ->withSkill('theology')
                    ->withTechniqueType('kata', 1, 5)
                    ->withTechnique('touch_the_void_dragon')
                    ->withTechnique('way_of_the_edgeless_sword')),
            'The Effortless Path',
        );
    }
}
