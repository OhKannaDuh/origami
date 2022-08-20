<?php

namespace Database\Seeders\SourceBooks\Core\Schools\Phoenix;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class AsakoLoremasterSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Asako Loremaster School',
            Family::query()->where('key', 'asako')->first(['id']),
            ['courtier'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'earth')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('culture')
                ->withKey('government')
                ->withKey('martial_arts_unarmed')
                ->withKey('medicine')
                ->withKey('performance')
                ->withKey('sentiment')
                ->withKey('theology'),
            45,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Shuji', [
                    'civility_foremost'
                ])
                ->withChoice('Shuji', 1, [
                    'ancestry_unearthed',
                    'cadence',
                ]),
            'Wisdom of the Ages',
            (new StartingOutfit())
                ->withItem('ceremonial_clothes')
                ->withItem('sanctified_robes')
                ->withItem('traveling_clothes')
                ->withItem('wakizashi')
                ->withItem('knife')
                ->withItem('scroll_satchel')
                ->withItem('calligraphy_set')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('games')
                    ->withSkill('martial_arts_unarmed')
                    ->withTechniqueSubtype('earth_shuji', 1)
                    ->withTechnique('open_hand_style', true)
                    ->withTechnique('divination'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('government')
                    ->withSkill('medicine')
                    ->withSkill('sentiment')
                    ->withTechniqueSubtype('air_shuji', 1, 2)
                    ->withTechnique('all_arts_are_one', true)
                    ->withTechnique('tea_ceremony'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('performance')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('fire_shuji', 1, 3)
                    ->withTechnique('pillar_of_calm', true)
                    ->withTechnique('ebb_and_flow'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('culture')
                    ->withSkill('medicine')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_shuji', 1, 4)
                    ->withTechnique('cleansing_spirit', true)
                    ->withTechnique('wolfs_proposal'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('performance')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('water_shuji', 1, 5)
                    ->withTechnique('still_the_elements', true)
                    ->withTechnique('bend_with_the_storm')),
            'Insufferable Genius',
        );
    }
}
