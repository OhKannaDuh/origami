<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Schools;

use App\Models\Core\SourceBook;
use App\Repositories\Character\FamilyRepositoryInterface;
use App\Repositories\Core\RingRepositoryInterface;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class TogashiChroniclerSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Togashi Chronicler School',
            $families->getByKey('togashi'),
            ['courtier', 'monk'],
            $rings->getByKey('earth'),
            $rings->getByKey('water'),
            4,
            (new StartingSkills())
                ->withKey('culture')
                ->withKey('fitness')
                ->withKey('labor')
                ->withKey('martial_arts_unarmed')
                ->withKey('meditation')
                ->withKey('performance'),
            40,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Ritual', [
                    'divination',
                ])
                ->withChoice('Kiho', 1, [
                    'cleansing_spirit',
                    'ki_protection',
                ])
                ->withChoice('Shuji', 1, [
                    'honest_assessment',
                    'truth_burns_through_lies',
                ]),
            'A Grain of Truth',
            // Traveling clothes, bo, knife, traveling pack.ADVANCE TYPE RANK 1 Scholar Skills Skl. Grp
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('performance')
                    ->withTechniqueSubtype('earth_shuji', 1, 1)
                    ->withTechnique('lord_togashis_insight', true)
                    ->withTechnique('beware_the_smallest_mouse'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('medicine')
                    ->withSkill('meditation')
                    ->withSkill('performance')
                    ->withTechniqueSubtype('water_shuji', 1, 2)
                    ->withTechnique('all_arts_are_one', true)
                    ->withTechnique('open_hand_style'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('culture')
                    ->withSkill('commerce')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('air_shuji', 1, 3)
                    ->withTechnique('the_great_silence', true)
                    ->withTechnique('the_ties_that_bind', true))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('culture')
                    ->withSkill('medicine')
                    ->withSkill('performance')
                    ->withTechniqueSubtype('fire_shuji', 1, 4)
                    ->withTechnique('breaking_blow', true)
                    ->withTechnique('foreseen_need'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('performance')
                    ->withTechniqueSubtype('void_shuji', 1, 4)
                    ->withTechnique('death_touch', true)
                    ->withTechnique('the_immovable_hand_of_peace')),
            'Echoes of Ancient Days',
        );
    }
}
