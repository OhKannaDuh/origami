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

final class KakitaDuelistSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Kakita Duelist School',
            Family::query()->where('key', 'kakita')->first(['id']),
            ['bushi', 'artisan'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'earth')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('courtesy')
                ->withKey('design')
                ->withKey('fitness')
                ->withKey('martial_arts_melee')
                ->withKey('meditation')
                ->withKey('sentiment')
                ->withKey('smithing'),
            50,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Kata', [
                    'iaijutsu_cut_rising_blade',
                ])
                ->withChoice('Shuji', 1, [
                    'shallow_waters',
                    'weight_of_duty',
                ]),
            'Way of the Crane',
            (new StartingOutfit())
                ->withItem('traveling_clothes')
                ->withItem('ceremonial_clothes')
                ->withDaisho()
                ->withChoice([
                    'yari',
                    'yumi',
                ])
                ->withItem('quiver_of_arrows')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('aesthetics')
                    ->withSkill('courtesy')
                    ->withSkill('sentiment')
                    ->withTechniqueType('kata', 1)
                    ->withTechnique('iaijutsu_cut_crossing_blade', true)
                    ->withTechnique('cadence'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('martial_arts_ranged')
                    ->withSkill('smithing')
                    ->withTechniqueType('kata', 1, 2)
                    ->withTechnique('all_arts_are_one', true)
                    ->withTechnique('thunderclap_strike', true))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('meditation')
                    ->withSkill('survival')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('a_samurais_fate', true)
                    ->withTechnique('heartpiercing_strike'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('fitness')
                    ->withSkill('tactics')
                    ->withSkill('martial_arts_melee')
                    ->withTechniqueType('kata', 1, 4)
                    ->withTechnique('striking_as_void', true)
                    ->withTechnique('pillar_of_calm'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('aesthetics')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('fire_shuji', 1, 5)
                    ->withTechnique('soul_sunder')
                    ->withTechnique('rouse_the_soul')),
            'Strike with No Thought',
        );
    }
}
