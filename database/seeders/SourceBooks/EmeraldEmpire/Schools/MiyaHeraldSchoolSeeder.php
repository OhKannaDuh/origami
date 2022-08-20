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

final class MiyaHeraldSchoolSeeder extends SchoolSeeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Miya Herald School',
            Family::query()->where('key', 'miya')->first(['id']),
            ['courtier'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('composition')
                ->withKey('courtesy')
                ->withKey('fitness')
                ->withKey('seafaring')
                ->withKey('sentiment')
                ->withKey('survival'),
            50,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Shuji', 1, [
                    'cadence',
                    'honest_assessment',
                ])
                ->withChoice('Shuji', 1, [
                    'shallow_waters',
                    'weight_of_duty',
                ]),
            'Voice of the Emperor',
            (new StartingOutfit())
                ->withItem('traveling_clothes')
                ->withItem('ceremonial_clothes')
                ->withItem('wakizashi')
                ->withChoice([
                    'yumi',
                    'tessen',
                ])
                ->withItem('quiver_of_arrows')
                ->withItem('calligraphy_set')
                ->withTravelingPack()
                ->withItem('personal_seal_or_chop'),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('culture')
                    ->withSkill('fitness')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('water_shuji', 1, 1)
                    ->withTechnique('feigned_opening', true)
                    ->withTechnique('courtiers_resolve'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('courtesy')
                    ->withSkill('culture')
                    ->withSkill('martial_arts_melee')
                    ->withTechniqueSubtype('air_shuji', 1, 2)
                    ->withTechnique('ebb_and_flow', true)
                    ->withTechnique('tributaries_of_trade'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('courtesy')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('earth_shuji', 1, 3)
                    ->withTechnique('awe_of_heaven', true)
                    ->withTechnique('the_wind_blows_both_ways'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('command')
                    ->withSkill('fitness')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('water_shuji', 1, 4)
                    ->withTechnique('buoyant_arrival', true)
                    ->withTechnique('pillar_of_calm'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('culture')
                    ->withSkill('sentiment')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('void_shuji', 1, 5)
                    ->withTechnique('sear_the_wound')
                    ->withTechnique('the_immovable_hand_of_peace')),
            'Blessings of the Emperor',
        );
    }
}
