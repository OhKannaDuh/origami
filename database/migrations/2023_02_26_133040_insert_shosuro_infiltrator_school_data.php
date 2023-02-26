<?php

use App\Models\Character\Technique;
use Database\Migrations\InsertSchoolDataMigration;
use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;

return new class extends InsertSchoolDataMigration
{


    public function up(): void
    {
        $school = $this->getSchool('shosuro_infiltrator_school');

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
            'key' => 'the_path_of_shadows',
            'name' => 'The Path of Shadows',
            'rank' => 1,
            'description' => 'While performing an Attack action against a target who is Compromised, Incapacitated, Unconscious, or unaware of your presence, treat the damage and deadliness of your weapon as being increased by your school rank.',
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
            'key' => 'the_final_silence',
            'name' => 'The Final Silence',
            'rank' => 6,
            'description' => 'As an Attack and Movement action, you may make a TN 4 Martial Arts [Unarmed] (Air) check targeting any number of minion NPCs at range 0-4. If you succeed during a narrative scene, you silently kill all targets over the course of a few minutes. If you succeed during a conflict scene, at the end of each of your turns, you may silently kill one of these targets at range 0-2 (in addition to your other actions).',
            'page_number' => $page,
        ]);
        assert($technique instanceof Technique);

        return $technique;
    }
};
