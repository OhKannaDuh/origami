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

final class ShikaMatchmakerSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Shika Matchmaker School',
            $families->getByKey('shika'),
            ['courtier', 'shugenja'],
            $rings->getByKey('air'),
            $rings->getByKey('water'),
            3,
            (new StartingSkills())
                ->withKey('composition')
                ->withKey('courtesy')
                ->withKey('culture')
                ->withKey('meditation')
                ->withKey('sentiment')
                ->withKey('theology'),
            50,
            ['air_invocations', 'water_invocations'],
            (new StartingTechniques())
                ->withGroup('Ritual', [
                    'the_ties_that_bind',
                ])
                ->withChoice('Invocation', 2, [
                    'blessed_wind',
                    'path_to_inner_peace',
                    'sympathetic_energies',
                    'tempest_of_air',
                ]),
            'Gift of Musubi-no-Kami',
            // Traveling clothes, ceremonial clothes, wakizashi, tea set
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('games')
                    ->withSkill('meditation')
                    ->withTechnique('ancestry_unearthed')
                    ->withTechnique('fun_and_games'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('medicine')
                    ->withSkill('sentiment')
                    ->withSkill('theology')
                    ->withTechnique('strike_the_tsunami', true)
                    ->withTechnique('civility_foremost'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('commerce')
                    ->withSkill('culture')
                    ->withSkill('government')
                    ->withTechnique('rise_air', true)
                    ->withTechnique('the_wind_blows_both_ways'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('meditation')
                    ->withSkill('sentiment')
                    ->withSkill('theology')
                    ->withTechnique('wrath_of_kaze_no_kami', true)
                    ->withTechnique('treaty_signing'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('composition')
                    ->withSkill('performance')
                    ->withTechnique('buoyant_arrival')
                    ->withTechnique('formal_tea_ceremony')),
            'Curse of Musubi-no-Kami',
        );
    }
}
