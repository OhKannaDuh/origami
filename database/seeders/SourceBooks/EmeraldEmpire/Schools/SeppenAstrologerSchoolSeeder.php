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

final class SeppenAstrologerSchoolSeeder extends SchoolSeeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Seppen Astrologer School',
            Family::query()->where('key', 'seppen')->first(['id']),
            ['shugenja', 'artisan'],
            Ring::query()->where('key', 'air')->first(['id']),
            Ring::query()->where('key', 'water')->first(['id']),
            3,
            (new StartingSkills())
                ->withKey('composition')
                ->withKey('government')
                ->withKey('medicine')
                ->withKey('meditation')
                ->withKey('sentiment')
                ->withKey('theology'),
            40,
            ['invocations', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withGroup('Invocations', [
                    'bind_the_shadow',
                ])
                ->withChoice('Invocations', 1, [
                    'dominion_of_suijin',
                    'jade_strike',
                ])
                ->withGroup('Ritausl', [
                    'divination',
                    'commune_with_the_spirits',
                    'threshold_barrier',
                ]),
            'Just as Predicted',
            (new StartingOutfit())
                ->withItem('sanctified_robes')
                ->withItem('concealed_armor')
                ->withItem('wakizashi')
                ->withChoice([
                    'bo',
                    'knife',
                ])
                ->withItem('calligraphy_set')
                ->withTravelingPack()
                ->withItem('scroll_satchel')
                ->withItem('divination_kit'),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('composition')
                    ->withSkill('skulduggery')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('water_invocations', 1, 1)
                    ->withTechnique('heart_of_the_water_dragon', true)
                    ->withTechnique('ancestry_unearthed'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('command')
                    ->withSkill('composition')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('air_invocations', 1, 2)
                    ->withTechnique('ebb_and_flow', true)
                    ->withTechnique('symbol_of_earth'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('sentiment')
                    ->withSkill('smithing')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_invocations', 1, 3)
                    ->withTechnique('false_realm_of_the_fox_spirits', true)
                    ->withTechnique('vapor_of_nightmares'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('sentiment')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('air_invocations', 1, 4)
                    ->withTechnique('tomb_of_jade', true)
                    ->withTechnique('a_samurais_fate'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('composition')
                    ->withSkill('skulduggery')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('water_invocations', 1, 5)
                    ->withTechnique('sear_the_wound')
                    ->withTechnique('the_souls_blade')),
            'Forseen in the Stars',
        );
    }
}
