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

final class TogashiTatooedOrderSeeder extends SchoolSeeder
{


    public function run(): void
    {
        $this->create(
            'Togashi Tattooed Order',
            Family::query()->where('key', 'togashi')->first(['id']),
            ['monk'],
            Ring::query()->where('key', 'earth')->first(['id']),
            Ring::query()->where('key', 'void')->first(['id']),
            4,
            (new StartingSkills())
                ->withKey('fitness')
                ->withKey('martial_arts_melee')
                ->withKey('martial_arts_unarmed')
                ->withKey('meditation')
                ->withKey('survival')
                ->withKey('theology'),
            40,
            ['kiho', 'shuji', 'rituals'],
            (new StartingTechniques())
                ->withChoice('kiho', 1, [
                    'earthen_fist',
                    'earth_needs_no_eyes',
                    'flame_fist',
                    'ki_protection',
                    'water_fist',
                ])
                ->withGroup('Shuji', [
                    'lord_togashis_insight',
                ]),
            'Blood of the Kami',
            (new StartingOutfit())
                ->withItem('common_clothes')
                ->withItem('bo')
                ->withTravelingPack(),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('fitness')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('fire_kiho', 1)
                    ->withTechnique('way_of_the_earthquake', true)
                    ->withTechnique('honest_assessment'))
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('command')
                    ->withSkill('composition')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('water_kiho', 1, 2)
                    ->withTechnique('open_hand_style', true)
                    ->withTechnique('stirring_the_embers'))
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('labor')
                    ->withSkill('meditation')
                    ->withTechniqueSubtype('air_kiho', 1, 3)
                    ->withTechnique('death_touch', true)
                    ->withTechnique('all_arts_are_one'))
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('labor')
                    ->withSkill('medicine')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('earth_kiho', 1, 4)
                    ->withTechnique('touch_the_void_dragon', true)
                    ->withTechnique('pillar_of_calm'))
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('meditation')
                    ->withSkill('martial_arts_unarmed')
                    ->withSkill('survival')
                    ->withTechniqueSubtype('void_kiho', 1, 5)
                    ->withTechniqueSubtype('rituals', 1, 5)
                    ->withTechnique('rouse_the_soul')),
            'Blood of the Dragon',
        );
    }
}
