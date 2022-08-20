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

final class FortunistMonkOrderSeeder extends SchoolSeeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Fortunist Monk Order',
            null,
            ['monk'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            4,
            (new StartingSkills())
                ->withKey('courtesy')
                ->withKey('culture')
                ->withKey('martial_arts_unarmed')
                ->withKey('meditation')
                ->withKey('survival')
                ->withKey('theology'),
            40,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Kata', [
                    'open_hand_style',
                ])
                ->withGroup('Ritauls', [
                    'cleansing_rite',
                    'threshold_barrier',
                ])
                ->withChoice('Shuji', 1, [
                    'shallow_waters',
                    'stirring_the_embers',
                ]),
            'Blessing of the Fortunes',
            (new StartingOutfit())
                ->withItem('sanctified_robes')
                ->withItem('ceremonial_clothes')
                ->withItem('bo')
                ->withTravelingPack()
                ->withItem('scroll_satchel'),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('courtesy')
                    ->withSkill('labor')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('earth_shuji', 1, 1)
                    ->withTechnique('crescent_moon_style', true)
                    ->withTechnique('commune_with_the_spirits'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('aesthetics')
                    ->withSkill('meditation')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('water_shuji', 1, 2)
                    ->withTechnique('all_arts_are_one', true)
                    ->withTechnique('rushing_avalanche_style'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('meditation')
                    ->withSkill('theology')
                    ->withTechniqueType('kata', 1, 3)
                    ->withTechnique('regal_bearing', true)
                    ->withTechnique('ebb_and_flow'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('culture')
                    ->withSkill('fitness')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('air_shuji', 1, 4)
                    ->withTechnique('buoyant_arrival', true)
                    ->withTechnique('pillar_of_calm'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('composition')
                    ->withSkill('meditation')
                    ->withSkill('performance')
                    ->withTechniqueSubtype('earth_shuji', 1, 5)
                    ->withTechnique('rouse_the_soul')
                    ->withTechnique('soul_sunder')),
            'Favor of the Fortunes',
        );
    }
}
