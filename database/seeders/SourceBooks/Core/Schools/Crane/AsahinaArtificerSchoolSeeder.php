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

final class AsahinaArtificerSchoolSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Asahina Artificer School',
            Family::query()->where('key', 'asahina')->first(['id']),
            ['shugenja', 'artisan'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'fire')->first(['id']),
            3,
            (new StartingSkills())
                ->withKey('aesthetics')
                ->withKey('courtesy')
                ->withKey('culture')
                ->withKey('design')
                ->withKey('games')
                ->withKey('theology'),
            50,
            ['invocations', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Invocations', 3, [
                    'blessed_wind',
                    'armor_of_radiance',
                    'inaris_blessing',
                    'reflections_of_pan_ku',
                    'token_of_memory',
                ])
                ->withGroup('Rituals', [
                    'commune_with_the_spirits',
                    'cleansing_rite',
                ]),
            'Spiritual Artisan',
            (new StartingOutfit())
                ->withItem('sanctified_robes')
                ->withItem('wakizashi')
                ->withItem('knife')
                ->withItem('yumi')
                ->withItem('quiver_of_arrows')
                ->withItem('scroll_satchel')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('courtesy')
                    ->withSkill('culture')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('air_invocations', 1)
                    ->withTechnique('path_to_inner_peace')
                    ->withTechnique('artisans_appraisal', true))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('aesthetics')
                    ->withSkill('design')
                    ->withSkill('performance')
                    ->withTechniqueSubtype('water_invocations', 1, 2)
                    ->withTechnique('grasp_of_the_air_dragon', true)
                    ->withTechnique('tea_ceremony'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('aesthetics')
                    ->withSkill('design')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('fire_invocations', 1, 3)
                    ->withTechnique('wings_of_the_phoenix', true)
                    ->withTechnique('vapor_of_nightmares'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('fitness')
                    ->withSkill('performance')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('water_invocations', 1, 4)
                    ->withTechnique('bend_with_the_storm', true)
                    ->withTechnique('rise_air'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('aesthetics')
                    ->withSkill('design')
                    ->withSkill('performance')
                    ->withTechniqueSubtype('air_invocations', 1, 5)
                    ->withTechnique('ever_changing_waves')
                    ->withTechnique('buoyant_arrival')),
            'Stir the Slumbering Spirit',
        );
    }
}
