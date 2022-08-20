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

final class ShinseistMonkOrderSeeder extends SchoolSeeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Fortunist Monk Order',
            null,
            ['monk'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'void')->first(['id']),
            4,
            (new StartingSkills())
                ->withKey('aesthetics')
                ->withKey('composition')
                ->withKey('fitness')
                ->withKey('martial_arts_unarmed')
                ->withKey('meditation')
                ->withKey('theology'),
            40,
            ['kata', 'kiho', 'rituals'],
            (new StartingTechniques())
                ->withGroup('Kata', [
                    'striking_as_earth',
                ])
                ->withGroup('Kiho', [
                    'cleansing_spirit',
                    'earth_needs_no_eyes',
                    'ki_protection',
                ]),
            'Embrace the Void',
            (new StartingOutfit())
                ->withItem('common_clothes')
                ->withchoice([
                    'bo',
                    'nunchaku',
                ])
                ->withItem('knife')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('composition')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueType('kata', 1, 1)
                    ->withTechnique('riding_the_clouds', true)
                    ->withTechnique('earthen_fist'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('aesthetics')
                    ->withSkill('courtesy')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('earth_kiho', 1, 2)
                    ->withTechniqueType('rituals', 1, 2)
                    ->withTechnique('all_arts_are_one', true))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('games')
                    ->withSkill('theology')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('grasp_the_earth_dragon')
                    ->withTechnique('way_of_the_willow'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('courtesy')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('water_kiho', 1, 4)
                    ->withTechnique('pillar_of_calm', true)
                    ->withTechnique('way_of_the_falling_star'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('meditation')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('void_kiho', 1, 5)
                    ->withTechnique('rouse_the_soul', true)
                    ->withTechnique('the_immovable_hand_of_peace', true)),
            'Embrace the Void',
        );
    }
}
