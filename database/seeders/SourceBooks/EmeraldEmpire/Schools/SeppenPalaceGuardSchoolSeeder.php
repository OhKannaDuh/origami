<?php

namespace Database\Seeders\SourceBooks\EmeraldEmpire\Schools;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use App\Models\Core\SourceBook;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class SeppenPalaceGuardSchoolSeeder extends SchoolSeeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Seppen Palace Guard School',
            Family::query()->where('key', 'seppen')->first(['id']),
            ['bushi'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'void')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('fitness')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_ranged')
                ->withKey('martial_arts_unarmed')
                ->withKey('meditation')
                ->withKey('sentiment')
                ->withKey('tactics'),
            50,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Kata', 1, [
                    'iaijutsu_cut_crossing_blade',
                    'iaijutsu_cut_rising_blade',
                ])
                ->withChoice('Shuji', 1, [
                    'ancestry_unearthed',
                    'honest_assessment',
                ]),
            'Speed of Heaven',
            (new StartingOutfit())
                ->withItem('lacquered_armor')
                ->withItem('sanctified_robes')
                ->withDaisho()
                ->withChoice([
                    'naginata',
                    'bisento',
                ])
                ->withItem('knife')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('government')
                    ->withSkill('sentiment')
                    ->withTechniqueType('kata', 1, 1)
                    ->withTechnique('crescent_moon_style', true)
                    ->withTechnique('weight_of_duty'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('courtesy')
                    ->withSkill('culture')
                    ->withSkill('games')
                    ->withTechniqueType('kata', 1, 2)
                    ->withTechnique('crimson_leaves_strike', true)
                    ->withTechnique('touchstone_of_courage', true))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('command')
                    ->withSkill('skulduggery')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('iron_in_the_mountains_style', true)
                    ->withTechnique('threshold_barrier'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('government')
                    ->withSkill('theology')
                    ->withTechniqueType('kata', 1, 4)
                    ->withTechnique('soul_sunder', true)
                    ->withTechnique('a_samurais_fate'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('sentiment')
                    ->withSkill('skulduggery')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1, 5)
                    ->withTechnique('rouse_the_soul')
                    ->withTechnique('the_immovable_hand_of_peace')),
            'The Clouds Part',
        );
    }
}
