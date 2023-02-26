<?php

use App\Models\Character\Technique;
use Database\Migrations\InsertSchoolDataMigration;
use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;

return new class extends InsertSchoolDataMigration
{


    public function up(): void
    {
        $school = $this->getSchool('shiba_guardian_school');

        $school->school_ability_id = $this->getSchoolAbility($school->page_number)->getKey();
        $school->mastery_ability_id = $this->getMasterAbility($school->page_number)->getKey();

        $school->save();
    }


    private function getSchoolAbility(int $page): Technique
    {
        $type = $this->techniqueSubtypes->getByKey('school_ability');
        assert($type instanceof TechniqueSubtype);

        $book = $this->books->getByKey('core');
        assert($book instanceof SourceBook);

        $technique = Technique::query()->create([
            'source_book_id' => $book->getKey(),
            'technique_subtype_id' => $type->getKey(),
            'key' => 'way_of_the_phoenix',
            'name' => 'Way of the Phoenix',
            'rank' => 1,
            'description' => 'Once per scene, when a character at range 0-3 makes a check that contains 1 or more {{strife}} symbols, you may negate all of those {{strife}} symbols. Then, that character removes strife and fatigue equal to your school rank.',
            'page_number' => $page,
        ]);
        assert($technique instanceof Technique);

        return $technique;
    }


    private function getMasterAbility(int $page): Technique
    {
        $type = $this->techniqueSubtypes->getByKey('mastery_ability');
        assert($type instanceof TechniqueSubtype);

        $book = $this->books->getByKey('core');
        assert($book instanceof SourceBook);

        $technique = Technique::query()->create([
            'source_book_id' => $book->getKey(),
            'technique_subtype_id' => $type->getKey(),
            'key' => 'stand_of_honor',
            'name' => 'Stand of Honor',
            'rank' => 6,
            'description' => 'At the end of your turn, you may spend 1 Void point to prepare to fend off advancing foes; this effect persists until the start of your next turn. When an enemy enters the range of one of your readied weapons, you may immediately make a Strike action using that weapon and targeting that enemy; if you succeed, the target suffers the Immobilized condition in addition to any other effects.',
            'page_number' => $page,
        ]);
        assert($technique instanceof Technique);

        return $technique;
    }
};
