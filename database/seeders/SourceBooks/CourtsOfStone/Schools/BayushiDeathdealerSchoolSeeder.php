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

final class BayushiDeathdealerSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Bayushi Deathdealer School',
            $families->getByKey('bayushi'),
            ['bushi', 'shinobi'],
            $rings->getByKey('air'),
            $rings->getByKey('fire'),
            5,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('courtesy')
                ->withKey('fitness')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_ranged')
                ->withKey('tactics')
                ->withKey('sentiment')
                ->withKey('skulduggery'),
            40,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Kata', 1, [
                    'striking_as_air',
                    'striking_as_fire',
                ])
                ->withGroup('Shuji', [
                    'assess_strengths',
                ]),
            'Way of the Scorpion',
            // Traveling clothes, ashigaru armor, daisho, knife, shinobigatana or folding half bow, traveling pack
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('courtesy')
                    ->withSkill('games')
                    ->withSkill('skulduggery')
                    ->withTechnique('deceitful_strike', true)
                    ->withTechnique('spiteful_loss'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('meditation')
                    ->withSkill('skulduggery')
                    ->withTechnique('deadly_sting', true)
                    ->withTechnique('iaijutsu_cut_rising_blade'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('courtesy')
                    ->withSkill('smithing')
                    ->withSkill('survival')
                    ->withTechnique('cunning_distraction', true)
                    ->withTechnique('all_shall_fear_me'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('games')
                    ->withSkill('tactics')
                    ->withTechnique('a_samurais_fate', true)
                    ->withTechnique('rallying_cry'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('tactics')
                    ->withTechnique('stillness_of_death', true)
                    ->withTechnique('hidden_in_smoke')),
            'Strike First, Strike Last',
        );
    }
}
