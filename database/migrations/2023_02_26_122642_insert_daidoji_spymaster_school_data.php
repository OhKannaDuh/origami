<?php

use App\Models\Character\School;
use App\Models\Character\Technique;
use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;
use App\Repositories\Character\SchoolRepositoryInterface;
use App\Repositories\Core\SourceBookRepositoryInterface;
use App\Repositories\Core\TechniqueSubtypeRepositoryInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\App;

return new class extends Migration
{
    private SchoolRepositoryInterface $repository;

    private TechniqueSubtypeRepositoryInterface $types;

    private SourceBookRepositoryInterface $books;


    public function __construct()
    {
        $this->repository = App::make(SchoolRepositoryInterface::class);
        $this->types = App::make(TechniqueSubtypeRepositoryInterface::class);
        $this->books = App::make(SourceBookRepositoryInterface::class);
    }


    public function up(): void
    {
        $school = $this->repository->bypassCache()->getByKey('daidoji_spymaster_school');
        assert($school instanceof School);

        $schoolAbilityType = $this->types->getByKey('school_ability');
        assert($schoolAbilityType instanceof TechniqueSubtype);

        $masteryAbilityType = $this->types->getByKey('mastery_ability');
        assert($masteryAbilityType instanceof TechniqueSubtype);

        $book = $this->books->getByKey('courts_of_stone');
        assert($book instanceof SourceBook);

        $school->starting_outfit = [
            [
                "type" => "item",
                "item_key" => "traveling_clothes",
                "quantity" => 1
            ],
            [
                "type" => "item",
                "item_key" => "ceremonial_clothes",
                "quantity" => 1
            ],
            [
                "type" => "item",
                "item_key" => "wakizashi",
                "quantity" => 1
            ],
            [
                "type" => "item",
                "item_key" => "sokutoki",
                "quantity" => 1
            ],
            [
                "type" => "item",
                "item_key" => "disguise_key",
                "quantity" => 1
            ],
            [
                "type" => "item",
                "item_key" => "opening_and_closing_tools",
                "quantity" => 1
            ],
        ];

        $schoolAbility = Technique::query()->create([
            'source_book_id' => $book->getKey(),
            'technique_subtype_id' => $schoolAbilityType->getKey(),
            'key' => 'incisive_insight',
            'name' => 'Incisive Insight',
            'rank' => 1,
            'description' => 'Once per scene, when making a check for a Scheme action targeting another character, you may receive a number of strife up to your school rank to reduce the TN by that amount (to a minimum of 1).',
            'page_number' => $school->page_number,
        ]);
        assert($schoolAbility instanceof Technique);
        $school->school_ability_id = $schoolAbility->getKey();

        $masteryAbility = Technique::query()->create([
            'source_book_id' => $book->getKey(),
            'technique_subtype_id' => $masteryAbilityType->getKey(),
            'key' => 'spy_network',
            'name' => 'Spy Network',
            'rank' => 6,
            'description' => 'As a downtime activity in any place of human habitation, you may make a TN 4 Skulduggery check to find an agent of the Daidoji spy network. If you succeed, you find this individual among the inhabitants of the city and gain the Ally advantage for them (see page 101 of the core rulebook). If you succeed with 2 or more bonus successes, the individual may occupy a low-to-mid-level position in a household or organization of your choosing.',
            'page_number' => $school->page_number,
        ]);
        assert($masteryAbility instanceof Technique);
        $school->mastery_ability_id = $masteryAbility->getKey();

        $school->save();
    }
};
