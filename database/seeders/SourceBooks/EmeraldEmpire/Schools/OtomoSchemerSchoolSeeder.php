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

final class OtomoSchemerSchoolSeeder extends SchoolSeeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Otomo Schemer School',
            Family::query()->where('key', 'otomo')->first(['id']),
            ['courtier'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'fire')->first(['id']),
            5,
            (new StartingSkills())
                ->withKey('command')
                ->withKey('composition')
                ->withKey('courtesy')
                ->withKey('culture')
                ->withKey('design')
                ->withKey('government')
                ->withKey('sentiment'),
            45,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Shuji', 1, [
                    'courtiers_resolve',
                    'stirring_the_embers',
                ])
                ->withGroup('Shuji', [
                    'slippery_maneuvers'
                ]),
            'Necessary Actions',
            (new StartingOutfit())
                ->withItem('ceremonial_clothes')
                ->withItem('wakizashi')
                ->withItem('calligraphy_set')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('composition')
                    ->withSkill('culture')
                    ->withSkill('government')
                    ->withTechniqueSubtype('air_shuji', 1, 1)
                    ->withTechnique('civility_foremost', true)
                    ->withTechnique('tea_ceremony', true))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('courtesy')
                    ->withSkill('martial_arts_melee')
                    ->withTechniqueSubtype('water_shuji', 1, 2)
                    ->withTechnique('awe_of_heaven', true)
                    ->withTechnique('prey_on_the_weak'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('commerce')
                    ->withSkill('courtesy')
                    ->withSkill('sentiment')
                    ->withTechniqueSubtype('fire_shuji', 1, 3)
                    ->withTechnique('regal_bearing', true)
                    ->withTechnique('the_wind_blows_both_ways'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('aesthetics')
                    ->withSkill('command')
                    ->withSkill('skulduggery')
                    ->withTechniqueSubtype('fire_shuji', 1, 4)
                    ->withTechnique('buoyant_arrival', true)
                    ->withTechnique('wolfs_proposal'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('composition')
                    ->withSkill('culture')
                    ->withSkill('design')
                    ->withTechniqueSubtype('air_shuji', 1, 5)
                    ->withTechnique('sear_the_wound')
                    ->withTechnique('the_immovable_hand_of_peace')),
            'Majesty of the Throne',
        );
    }
}
