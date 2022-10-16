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

final class DaidojiSpymasterSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Daidoji Spymaster School',
            $families->getByKey('daidoji'),
            ['courtier', 'shinobi'],
            $rings->getByKey('air'),
            $rings->getByKey('earth'),
            5,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('courtesy')
                ->withKey('culture')
                ->withKey('government')
                ->withKey('performance')
                ->withKey('sentiment')
                ->withKey('skulduggery'),
            35,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Shuji', [
                    'ancestry_unearthed',
                ])
                ->withChoice('Ninjutsu', 1, [
                    'like_a_ghost',
                    'skulk',
                ])
                ->withChoice('Kata', 1, [
                    'striking_as_air',
                    'striking_as_earth',
                ]),
            'Incisive Insight',
            // Traveling clothes, ceremonial clothes, wakizashi, sokutoki, disguise kit, opening and closing kit
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('command')
                    ->withSkill('culture')
                    ->withSkill('government')
                    ->withTechniqueSubtype('air_shuji', 1, 1)
                    ->withTechnique('lady_dojis_decree', true)
                    ->withTechnique('weight_of_duty'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('games')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('earth_shuji', 1, 2)
                    ->withTechnique('whats_yours_is_mine', true)
                    ->withTechnique('treaty_signing'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('culture')
                    ->withSkill('sentiment')
                    ->withSkill('martial_arts_unarmed')
                    ->withTechniqueSubtype('air_shuji', 1, 3)
                    ->withTechnique('hidden_in_smoke', true)
                    ->withTechnique('open_hand_style'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('command')
                    ->withSkill('government')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('water_shuji', 1, 4)
                    ->withTechnique('cunning_distraction', true)
                    ->withTechnique('wolfs_proposal'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('earth_shuji', 1, 5)
                    ->withTechnique('noxious_cloud', true)
                    ->withTechnique('bend_with_the_storm')),
            'Spy Network',
        );
    }
}
