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

final class KuniWardenSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Kuni Warden School',
            $families->getByKey('kuni'),
            ['monk'],
            $rings->getByKey('fire'),
            $rings->getByKey('void'),
            4,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_unarmed')
                ->withKey('meditation')
                ->withKey('performance')
                ->withKey('theology'),
            34,
            ['kiho', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Kiho', 1, [
                    'cleansing_spirit',
                    'flame_fist',
                ])
                ->withChoice('Rituals', 1, [
                    'cleansing_rite',
                    'threshold_barrier',
                ])
                ->withGroup('Shuji', [
                    'truth_burns_through_lies',
                ]),
            'Suppressing Blows',
            // Sanctified robes, concealed armor, daisho (kabutowari and wakizashi), calligraphy kit, traveling pack
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('meditation')
                    ->withTechniqueType('kata', 1, 1)
                    ->withTechnique('courtiers_resolve')
                    ->withTechnique('the_body_is_an_anvil'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('performance')
                    ->withSkill('sentiment')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('fire_kiho', 1, 2)
                    ->withTechnique('crimson_leaves_strike', true)
                    ->withTechnique('coiling_serpent_style', true))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_kiho', 1, 3)
                    ->withTechnique('thunderclap_strike', true)
                    ->withTechnique('rallying_cry'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('government')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('void_shuji', 1, 4)
                    ->withTechnique('bravado')
                    ->withTechnique('death_touch'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('void_kiho', 1, 5)
                    ->withTechnique('striking_as_void', true)
                    ->withTechnique('sear_the_wound')),
            'Sacred Fist',
        );
    }
}
