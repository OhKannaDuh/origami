<?php

use App\Models\Character\Technique;
use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;
use Database\Migrations\InsertSchoolDataMigration;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\CurriculumRank;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingTechniques;

return new class extends InsertSchoolDataMigration
{


    public function up(): void
    {
        $school = $this->getSchool('kitsu_realm_wanderer_school');
        $school->name = 'Kitsu Realm Wanderer School';
        $school->family_id = $this->getFamily('kitsu')->getKey();

        $school->ring_one_id = $this->getRing('void')->getKey();
        $school->ring_two_id = $this->getRing('water')->getKey();

        $school->schoolTypes()->attach($this->getSchoolType('shugenja')->getKey());
        $school->schoolTypes()->attach($this->getSchoolType('bushi')->getKey());

        $school->starting_skill_amount = 3;
        $school->starting_skills = [
            'fitness',
            'martial_arts_melee',
            'meditation',
            'sentiment',
            'survival',
            'theology',
        ];

        $school->honor = 50;

        $school->availableTechniqueTypes()->attach($this->getTechniqueType('kata')->getKey());
        $school->availableTechniqueTypes()->attach($this->getTechniqueType('rituals')->getKey());
        $school->availableTechniqueTypes()->attach($this->getTechniqueType('shuji')->getKey());

        $school->school_ability_id = $this->getSchoolAbility($school->page_number)->getKey();
        $school->mastery_ability_id = $this->getMasterAbility($school->page_number)->getKey();

        $school->starting_techniques = $this->getStartingTechniques()->toArray();
        $school->curriculum = $this->getCurriculum()->toArray();
        $school->starting_outfit = $this->getStartingOutfit()->toArray();

        $school->save();
    }


    private function getSchoolAbility(int $page): Technique
    {
        $type = $this->techniqueSubtypes->getByKey('school_ability');
        assert($type instanceof TechniqueSubtype);

        $book = $this->books->getByKey('celestial_realms');
        assert($book instanceof SourceBook);

        $technique = Technique::query()->create([
            'source_book_id' => $book->getKey(),
            'technique_subtype_id' => $type->getKey(),
            'key' => 'celestial_alignment',
            'name' => 'Celestial Alignment',
            'rank' => 1,
            'description' => 'As a Support action, you may make a TN 2 Meditation (Void) check to draw one of the Spirit Realms closer to your current location. A number of range bands around your current position up to your school rank become a place of power of the realm you choose (see page 138 for more information). This effect persists until the end of the scene.',
            'page_number' => $page,
        ]);
        assert($technique instanceof Technique);

        return $technique;
    }


    private function getMasterAbility(int $page): Technique
    {
        $type = $this->techniqueSubtypes->getByKey('mastery_ability');
        assert($type instanceof TechniqueSubtype);

        $book = $this->books->getByKey('celestial_realms');
        assert($book instanceof SourceBook);

        $technique = Technique::query()->create([
            'source_book_id' => $book->getKey(),
            'technique_subtype_id' => $type->getKey(),
            'key' => 'walk_the_hidden_ways',
            'name' => 'Walk the Hidden Ways',
            'rank' => 6,
            'description' => 'When you use your school ability in a place already linked to a particular realm, such as a place of power, you may move yourself and a number of characters up to your ranks in Meditation into that realm fully, leaving the Mortal Realm entirely. As a Support action, you may make a TN 2 Meditation (Void) check to return yourself and a number of characters up to your ranks in Meditation to the Mortal Realm.',
            'page_number' => $page,
        ]);
        assert($technique instanceof Technique);

        return $technique;
    }


    private function getStartingTechniques(): StartingTechniques
    {
        return (new StartingTechniques())
            ->withChoice('Invocations', 3, [
                'biting_steel',
                'blessed_wind',
                'courage_of_seven_thunders',
                'natures_touch',
                'the_rushing_wave',
            ])
            ->withGroup('Kata', [
                'striking_as_water',
            ])
            ->withGroup('Rituals', [
                'commune_with_the_spirits',
                'divination',
            ]);
    }


    private function getCurriculum(): Curriculum
    {
        return (new Curriculum())
            ->withRank(1, (new CurriculumRank())
                ->withSkillGroup('martial')
                ->withSkill('sentiment')
                ->withSkill('survival')
                ->withSkill('theology')
                ->withTechniqueSubtype('water_invocations', 1, 1)
                ->withTechnique('rite_of_the_wheel', true)
                ->withTechnique('warriors_resolve'))
            ->withRank(2, (new CurriculumRank())
                ->withSkillGroup('trade')
                ->withSkill('martial_arts_melee')
                ->withSkill('meditation')
                ->withSkill('theology')
                ->withTechniqueSubtype('earth_invocations', 1, 2)
                ->withTechnique('messenger_of_chikusho_do', true)
                ->withTechnique('iron_forest_style'))
            ->withRank(3, (new CurriculumRank())
                ->withSkillGroup('scholar')
                ->withSkill('composition')
                ->withSkill('meditation')
                ->withSkill('tactics')
                ->withTechniqueSubtype('fire_invocations', 1, 3)
                ->withTechnique('bond_of_the_realms', true)
                ->withTechnique('thunderclap_strike'))
            ->withRank(4, (new CurriculumRank())
                ->withSkillGroup('social')
                ->withSkill('commerce')
                ->withSkill('meditation')
                ->withSkill('theology')
                ->withTechniqueSubtype('air_invocations', 1, 4)
                ->withTechnique('crashing_wave_style')
                ->withTechnique('prayer_of_protection'))
            ->withRank(5, (new CurriculumRank())
                ->withSkillGroup('artisan')
                ->withSkill('martial_arts_melee')
                ->withSkill('meditation')
                ->withSkill('theology')
                ->withTechniqueSubtype('water_invocations', 1, 5)
                ->withTechnique('soul_sunder')
                ->withTechnique('rain_of_ten_thousand_lotuses', true));
    }


    private function getStartingOutfit(): StartingOutfit
    {
        return (new StartingOutfit())
            ->withItem('traveling_clothes')
            ->withItem('ceremonial_clothes')
            ->withDaisho()
            ->withChoice([
                'yari',
                'bo'
            ])
            ->withItem('scroll_satchel')
            ->withTravelingPack();
    }
};
