<?php

namespace Database\Seeders;

use App\Models\Core\SourceBook;
use App\Repositories\Character\FamilyRepositoryInterface;
use App\Repositories\Core\RingRepositoryInterface;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Database\Seeders\SourceBooks\SchoolSeeder;

final class KitsuRealmWandererSchoolSeeder extends SchoolSeeder
{


    public function run(
        SourceBook $sourceBook,
        FamilyRepositoryInterface $families,
        RingRepositoryInterface $rings,
    ): void {
        $this->sourceBook = $sourceBook;

        $this->create(
            'Kitsu Realm Wanderer School',
            $families->getByKey(''),
            ['shugenja', 'bushi'],
            $rings->getByKey('void'),
            $rings->getByKey('water'),
            3,
            (new StartingSkills())
                ->withKey('fitness')
                ->withKey('martial_arts_melee')
                ->withKey('meditation')
                ->withKey('sentiment')
                ->withKey('survival')
                ->withKey('theology'),
            50,
            ['kata', 'rituals', 'shuji'],
            (new StartingTechniques())
                ->withChoice('Invocations', 3, [
                    'biting_steel',
                    'blessed_wind',
                    'courage_of_seven_thun__ders',
                    'natures_touch',
                    'the_rushing_wave',
                ])
                ->withGroup('Kata', [
                    'striking_as_water',
                ])
                ->withGroup('Rituals', [
                    'commune_with_the_spirits',
                    'divination',
                ])
,

            'Celestial Alignment',
            // Traveling clothes, ceremonial clothes, daisho (katana and wakizashi), yari (spear) or bo (staff), scroll satchel, pouch of incense, traveling pack
            (new StartingOutfit()),
            (new Curriculum())
                ->withRank(1, (new CurriculumRank())
                    ->withSkillGroup('martial')
                    ->withSkill('sentiment')
                    ->withSkill('survival')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('water_invocations', 1, 1)
                    ->withTechnique('rite_of_the_wheel', true)
                    ->withTechnique('warriors_resolve')
            )
                ->withRank(2, (new CurriculumRank())
                    ->withSkillGroup('trade')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('meditation')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('earth_invocations', 1, 2)
                    ->withTechnique('messenger_of_chikusho_do', true)
                    ->withTechnique('iron_forest_style')
            )
                ->withRank(3, (new CurriculumRank())
                    ->withSkillGroup('scholar')
                    ->withSkill('composition')
                    ->withSkill('meditation')
                    ->withSkill('tactics')
                    ->withTechniqueSubtype('fire_invocations', 1, 3)
                    ->withTechnique('bond_of_the_realms', true)
                    ->withTechnique('thunderclap_strike')
            )
                ->withRank(4, (new CurriculumRank())
                    ->withSkillGroup('social')
                    ->withSkill('commerce')
                    ->withSkill('meditation')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('air_invocations', 1, 4)
                    ->withTechnique('crashing_wave_style')
                    ->withTechnique('prayer_of_protection')
            )
                ->withRank(5, (new CurriculumRank())
                    ->withSkillGroup('artisan')
                    ->withSkill('martial_arts_melee')
                    ->withSkill('meditation')
                    ->withSkill('theology')
                    ->withTechniqueSubtype('water_invocations', 1, 5)
                    ->withTechnique('soul_sunder')
                    ->withTechnique('rain_of_ten_thousand_lotuses', true)
            )
,


            'Walk the Hidden Ways',
        );

    }
}
