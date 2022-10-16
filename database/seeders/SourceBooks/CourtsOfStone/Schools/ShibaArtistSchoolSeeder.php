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

final class ShibaArtistSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Shiba Artist School',
            $families->getByKey('shiba'),
            ['artisan'],
            $rings->getByKey('fire'),
            $rings->getByKey('void'),
            5,
            (new StartingSkills())
                ->withKey('aesthetics')
                ->withKey('composition')
                ->withKey('courtesy')
                ->withKey('culture')
                ->withKey('design')
                ->withKey('performance')
                ->withKey('smithing'),
            50,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Ritual', [
                    'tea_ceremony',
                ])
                ->withChoice('Shuji', 2, [
                    'assess_strengths',
                    'courtiers_resolve',
                    'fun_and_games',
                ]),
            'Architect of Tranquility',
            // Ceremonial clothes, common clothes, traveling clothes, wakizashi, traveling pack, calligraphy set
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('courtesy')
                    ->withSkill('culture')
                    ->withSkill('performance')
                    ->withTechniqueSubtype('fire_shuji', 1, 1)
                    ->withTechnique('offend_the_sensibilities', true)
                    ->withTechnique('fun_and_games'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('aesthetics')
                    ->withSkill('government')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('air_shuji', 1, 2)
                    ->withTechnique('the_wind_blows_both_ways', true)
                    ->withTechnique('civility_foremost'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('command')
                    ->withSkill('government')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('water_shuji', 1, 3)
                    ->withTechnique('formal_tea_ceremony', true)
                    ->withTechnique('all_arts_are_one'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('performance')
                    ->withSkill('composition')
                    ->withSkill('smithing')
                    ->withTechniqueSubtype('void_shuji', 1, 4)
                    ->withTechnique('rouse_the_soul', true)
                    ->withTechnique('hidden_in_smoke'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('culture')
                    ->withSkill('courtesy')
                    ->withSkill('performance')
                    ->withTechniqueType('rituals', 1, 5)
                    ->withTechnique('bend_with_the_storm', true)
                    ->withTechnique('buoyant_arrival')),
            'Sudden Clarity',
        );
    }
}
