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

final class DojiBureaucratSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Doji Bureaucrat School',
            $families->getByKey('doji'),
            ['courtier'],
            $rings->getByKey('earth'),
            $rings->getByKey('water'),
            5,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('composition')
                ->withKey('courtesy')
                ->withKey('culture')
                ->withKey('games')
                ->withKey('government')
                ->withKey('meditation'),
            55,
            ['rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Shuji', [
                    'courtiers_resolve',
                    'stonewall_tactics',
                ]),
            'Procedure and Protocol',
            // Ceremonial clothing, wakizashi, legal primer, blank forms, calligraphy kit, scroll designating the bearer as an individual of decidedly moderate authority
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('commerce')
                    ->withSkill('composition')
                    ->withSkill('courtesy')
                    ->withTechniqueSubtype('earth_shuji', 1, 1)
                    ->withTechnique('treaty_signing', true)
                    ->withTechnique('beware_the_smallest_mouse'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('courtesy')
                    ->withSkill('games')
                    ->withSkill('government')
                    ->withTechnique('the_wind_blows_both_ways', true)
                    ->withTechnique('unyielding_terms'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('commerce')
                    ->withSkill('culture')
                    ->withSkill('sentiment')
                    ->withTechnique('hidden_in_smoke', true)
                    ->withTechnique('all_shall_fear_me'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('meditation')
                    ->withSkill('tactics')
                    ->withTechnique('the_immovable_hand_of_peace', true)
                    ->withTechnique('rallying_cry'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('performance')
                    ->withSkill('tactics')
                    ->withTechnique('bend_with_the_storm')
                    ->withTechnique('formal_tea_ceremony')),
            'Post Facto',
        );
    }
}
