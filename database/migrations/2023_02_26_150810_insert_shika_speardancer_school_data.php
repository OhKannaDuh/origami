<?php

use App\Models\Character\Technique;
use Database\Migrations\InsertSchoolDataMigration;
use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;
use Database\Seeders\Helpers\StartingOutfit;

return new class extends InsertSchoolDataMigration
{


    public function up(): void
    {
        $school = $this->getSchool('shika_speardancer_school');

        $school->school_ability_id = $this->getSchoolAbility($school->page_number)->getKey();
        $school->mastery_ability_id = $this->getMasterAbility($school->page_number)->getKey();
        $school->starting_outfit = $this->getStartingOutfit()->toArray();

        $school->save();
    }


    private function getSchoolAbility(int $page): Technique
    {
        $type = $this->techniqueSubtypes->getByKey('school_ability');
        assert($type instanceof TechniqueSubtype);

        $book = $this->books->getByKey('courts_of_stone');
        assert($book instanceof SourceBook);

        $technique = Technique::query()->create([
            'source_book_id' => $book->getKey(),
            'technique_subtype_id' => $type->getKey(),
            'key' => 'typhoon_in_the_bamboo_grove',
            'name' => 'Typhoon in the Bamboo Grove',
            'rank' => 1,
            'description' => 'When making a Martial Arts [Melee] or Fitness check, you may spend {{opportunity}}{{opportunity}} to cause a number of characters no greater than your school rank and within range of your readied weapon to suffer the Dazed condition.',
            'page_number' => $page,
        ]);
        assert($technique instanceof Technique);

        return $technique;
    }


    private function getMasterAbility(int $page): Technique
    {
        $type = $this->techniqueSubtypes->getByKey('mastery_ability');
        assert($type instanceof TechniqueSubtype);

        $book = $this->books->getByKey('courts_of_stone');
        assert($book instanceof SourceBook);

        $technique = Technique::query()->create([
            'source_book_id' => $book->getKey(),
            'technique_subtype_id' => $type->getKey(),
            'key' => 'the_lowest_bow',
            'name' => 'The Lowest Bow',
            'rank' => 6,
            'description' => 'When performing an Attack action using Martial Arts [Melee], you may spend {{opportunity}} as follows: <ul><li><strong>{{opportunity}}+<strong/>: Choose one character other than your target at range 2 with vigilance lower than or equal to {{opportunity}} spent this way. That character suffers a critical strike with severity equal to your weapon\'s deadliness plus your ranks in Martial Arts [Melee].</li></ul>',
            'page_number' => $page,
        ]);
        assert($technique instanceof Technique);

        return $technique;
    }


    private function getStartingOutfit(): StartingOutfit
    {
        return (new StartingOutfit())
            ->withItem('traveling_clothes')
            ->withItem('stealth_clothing')
            ->withItem('ashigaru_armor')
            ->withChoice([
                'yari',
                'kamayari'
            ])
            ->withItem('wakizashi')
            ->withTravelingPack();
    }
};
