<?php

namespace Database\Seeders\SourceBooks\EmeraldEmpire\Schools;

use App\Models\Core\Ring;
use App\Models\Core\SourceBook;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class KolatSaboteurConspiracySeeder extends SchoolSeeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Kolat Saboteur Conspiracy',
            null,
            ['shinobi'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('commerce')
                ->withKey('fitness')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_ranged')
                ->withKey('medicine')
                ->withKey('meditation')
                ->withKey('skulduggery'),
            20,
            ['kata', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Kata', [
                    'veiled_menace_style',
                ])
                ->withGroup('Ninjutsu', [
                    'skulk',
                ])
                ->withGroup('Shuji', [
                    'cadence',
                ]),
            'Professional Savoteur',
            (new StartingOutfit())
                ->withItem('ceremonial_clothes')
                ->withItem('common_clothes')
                ->withItem('traveling_clothes')
                ->withDaisho()
                ->withItem('knife')
                ->withItem('shuriken', 5)
                ->withItem('poison_one_vial')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('courtesy')
                    ->withSkill('performance')
                    ->withSkill('skulduggery')
                    ->withTechniqueType('kata', 1, 1)
                    ->withTechnique('deadly_sting', true)
                    ->withTechnique('shallow_waters'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('commerce')
                    ->withSkill('medicine')
                    ->withSkill('skulduggery')
                    ->withTechniqueType('kata', 1, 2)
                    ->withTechnique('noxious_cloud', true)
                    ->withTechnique('tributaries_of_trade'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('composition')
                    ->withSkill('smithing')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('ebb_and_flow')
                    ->withTechnique('spin_the_web'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('commerce')
                    ->withSkill('skulduggery')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1, 4)
                    ->withTechnique('silencing_stroke', true)
                    ->withTechnique('wolfs_proposal'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('commerce')
                    ->withSkill('skulduggery')
                    ->withTechniqueType('kata', 1, 5)
                    ->withTechnique('buoyant_arrival')),
            'Usher in the New Age',
        );
    }
}
