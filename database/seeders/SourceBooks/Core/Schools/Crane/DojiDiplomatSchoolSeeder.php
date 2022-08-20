<?php

namespace Database\Seeders\SourceBooks\Core\Schools\Crane;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class DojiDiplomatSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Doji Diplomat School',
            Family::query()->where('key', 'doji')->first(['id']),
            ['courtier'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('aesthetics')
                ->withKey('composition')
                ->withKey('courtesy')
                ->withKey('culture')
                ->withKey('design')
                ->withKey('government')
                ->withKey('martial_arts_ranged'),
            50,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Shuji', 1, [
                    'cadence',
                    'shallow_waters',
                    'whispers_of_court',
                ])
                ->withGroup('Shuji', [
                    'lady_dojis_decree',
                ]),
            'Speaking in Silence',
            (new StartingOutfit())
                ->withItem('ceremonial_clothes')
                ->withItem('wakizashi')
                ->withChoice([
                    'yumi',
                    'yari',
                ])
                ->withItem('calligraphy_set')
                ->withTravelingPack(),
            // -> with attendant or rokugani pony
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('aesthetics')
                    ->withSkill('culture')
                    ->withSkill('composition')
                    ->withTechniqueSubtype('air_shuji', 1)
                    ->withTechnique('civility_foremost', true)
                    ->withTechnique('tea_ceremony', true))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('courtesy')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('water_shuji', 1, 2)
                    ->withTechnique('the_wind_blows_both_ways', true)
                    ->withTechnique('artisans_appraisal'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('courtesy')
                    ->withSkill('games')
                    ->withSkill('performance')
                    ->withTechniqueSubtype('earth_shuji', 1, 3)
                    ->withTechnique('regal_bearing', true)
                    ->withTechnique('ebb_and_flow'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('government')
                    ->withSkill('composition')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('air_shuji', 1, 4)
                    ->withTechnique('bend_with_the_storm', true)
                    ->withTechnique('pillar_of_calm'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('aesthetics')
                    ->withSkill('courtesy')
                    ->withSkill('command')
                    ->withTechniqueSubtype('void_shuji', 1, 5)
                    ->withTechnique('buoyant_arrival')
                    ->withTechnique('the_immovable_hand_of_peace')),
            'The Lady\'s Grace',
        );
    }
}
