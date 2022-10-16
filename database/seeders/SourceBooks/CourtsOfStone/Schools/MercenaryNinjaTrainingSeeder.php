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

final class MercenaryNinjaTrainingSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Mercenary Ninja Training',
            null,
            ['shinobi'],
            $rings->getByKey('air'),
            # ToDo: any other ring
            $rings->getByKey('void'),
            5,
            (new StartingSkills())
                ->withKey('fitness')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_ranged')
                ->withKey('martial_arts_unarmed')
                ->withKey('medicine')
                ->withKey('skulduggery')
                ->withKey('survival'),
            20,
            ['kata', 'ninjutsu', 'rituals'],
            (new StartingTechniques())
                ->withGroup('Ninjutsu', [
                    'skulk',
                ])
                ->withChoice('Shuji', 1, [
                    'cadence',
                    'shallow_waters',
                ]),
            'Disciple of Darkness',
            // Kusarifundo or tekken, kama or nin- jato, 3 shuriken or blowgun, stealth clothing, peasant clothes, 50 feet of rope, tenugui
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('performance')
                    ->withSkill('skulduggery')
                    ->withSkill('survival')
                    ->withTechnique('beware_the_smallest_mouse', true)
                    ->withTechnique('like_a_ghost', true))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('martial_arts_unarmed')
                    ->withTechnique('silent_elimination', true)
                    ->withTechnique('veiled_menace_style'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('medicine')
                    ->withSkill('smithing')
                    ->withTechnique('feigned_opening', true)
                    ->withTechnique('slicing_wind_kick'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                            ->withSkillGroup('scholar')
                    ->withSkill('seafaring')
                    ->withSkill('skulduggery')
                    ->withTechnique('hidden_in_smoke', true)
                    ->withTechnique('breath_of_wind_style')
                    ->withTechnique('silencing_stroke'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('meditation')
                    ->withSkill('tactics')
                    ->withSkill('theology')
                    ->withTechnique('foreseen_need', true)
                    ->withTechnique('striking_as_void')),
            'One with the Shadows',
        );
    }
}
