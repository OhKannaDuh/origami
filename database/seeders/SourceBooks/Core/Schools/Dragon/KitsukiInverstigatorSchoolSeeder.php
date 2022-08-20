<?php

namespace Database\Seeders\SourceBooks\Core\Schools\Dragon;

use App\Models\Character\Family;
use App\Models\Core\Ring;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class KitsukiInverstigatorSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Kitsuki Inverstigator School',
            Family::query()->where('key', 'kitsuki')->first(['id']),
            ['courtier', 'bushi'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'earth')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('culture')
                ->withKey('government')
                ->withKey('martial_arts_melee')
                ->withKey('medicine')
                ->withKey('sentiment')
                ->withKey('skulduggery')
                ->withKey('survival'),
            45,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Kata', 1, [
                    'striking_as_water',
                    'tactical_assessment',
                ])
                ->withGroup('Shuji', [
                    'shallow_waters',
                ]),
            'Kitsuki\'s Method',
            (new StartingOutfit())
                ->withItem('traveling_clothes')
                ->withItem('wakizashi')
                ->withItem('knife')
                ->withItem('calligraphy_set')
                ->withChoice([
                    'bo',
                    'jian',
                ])
                ->withTravelingPack()
                ->withItem('journal'),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('fitness')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('fire_shuji', 1)
                    ->withTechnique('slippery_maneuvers', true)
                    ->withTechnique('honest_assessment'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('sentiment')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1, 2)
                    ->withTechnique('all_arts_are_one', true)
                    ->withTechnique('feigned_opening'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('meditation')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('earth_shuji', 1, 3)
                    ->withTechnique('regal_bearing', true)
                    ->withTechnique('battle_in_the_mind'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('sentiment')
                    ->withSkill('medicine')
                    ->withSkill('skulduggery')
                    ->withTechniqueType('kata', 1, 4)
                    ->withTechnique('sear_the_wound', true)
                    ->withTechnique('bravado'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('sentiment')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('fire_shuji', 1, 5)
                    ->withTechnique('wolfs_proposal')
                    ->withTechnique('crashing_wave_style')),
            'The Eyes Betray the Heart',
        );
    }
}
