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

final class KakitaSwordsmithSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Kakita Swordsmith School',
            $families->getByKey('kakita'),
            ['artisan', 'courtier'],
            $rings->getByKey('air'),
            $rings->getByKey('fire'),
            5,
            (new StartingSkills())
                ->withKey('aesthetics')
                ->withKey('martial_arts_melee')
                ->withKey('courtesy')
                ->withKey('culture')
                ->withKey('sentiment')
                ->withKey('smithing')
                ->withKey('theology'),
            55,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Kata', 1, [
                    'soaring_slice',
                    'striking_as_air',
                    'striking_as_fire',
                ])
                ->withGroup('Shuji', [
                    'artisans_appraisal',
                ]),
            'Sacred Art of Steel',
            // Traveling clothes, ceremonial clothes, daisho (a personally crafted katana with Kakita pattern [see page 109] and wakizashi), smithing hammer, traveling pack, an attendant (see page 64 of the core rulebook) or Rokugani pony (see page 326 of the core rulebook)
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('courtesy')
                    ->withSkill('culture')
                    ->withSkill('martial_arts_melee')
                    ->withTechniqueType('kata', 1, 1)
                    ->withTechnique('blessing_of_steel', true)
                    ->withTechnique('well_of_desire'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('aesthetics')
                    ->withSkill('meditation')
                    ->withSkill('smithing')
                    ->withTechniqueType('rituals', 1, 2)
                    ->withTechnique('ebb_and_flow', true)
                    ->withTechnique('tributaries_of_trade'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('sentiment')
                    ->withSkill('smithing')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('air_shuji', 1, 4)
                    ->withTechnique('all_arts_are_one')
                    ->withTechnique('dazzling_performance'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('courtesy')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('performance')
                    ->withTechniqueType('kata', 1, 4)
                    ->withTechnique('soul_sunder', true)
                    ->withTechnique('bravado'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('aesthetics')
                    ->withSkill('design')
                    ->withSkill('smithing')
                    ->withTechniqueSubtype('fire_shuji', 1, 5)
                    ->withTechnique('buoyant_arrival')
                    ->withTechnique('striking_as_void')),
            'Ashidaka\'s Method',
        );
    }
}
