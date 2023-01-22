<?php

namespace App\Console\Commands;

use App\Models\Character\Advantage;
use App\Models\Character\Clan;
use App\Models\Character\Disadvantage;
use App\Models\Character\Family;
use App\Models\Character\Item;
use App\Models\Character\School;
use App\Models\Character\Technique;
use App\Models\Core\AdvantageType;
use App\Models\Core\DisadvantageType;
use App\Models\Core\ItemSubtype;
use App\Models\Core\ItemType;
use App\Models\Core\Ring;
use App\Models\Core\SchoolType;
use App\Models\Core\Skill;
use App\Models\Core\SkillGroup;
use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;
use App\Models\Core\TechniqueType;
use App\Repositories\Character\AdvantageRepositoryInterface;
use App\Repositories\Character\ClanRepositoryInterface;
use App\Repositories\Character\DisadvantageRepositoryInterface;
use App\Repositories\Character\FamilyRepositoryInterface;
use App\Repositories\Character\ItemRepositoryInterface;
use App\Repositories\Character\SchoolRepositoryInterface;
use App\Repositories\Character\TechniqueRepositoryInterface;
use App\Repositories\Core\AdvantageTypeRepositoryInterface;
use App\Repositories\Core\DisadvantageTypeRepositoryInterface;
use App\Repositories\Core\ItemSubtypeRepositoryInterface;
use App\Repositories\Core\ItemTypeRepositoryInterface;
use App\Repositories\Core\RingRepositoryInterface;
use App\Repositories\Core\SchoolTypeRepositoryInterface;
use App\Repositories\Core\SkillGroupRepositoryInterface;
use App\Repositories\Core\SkillRepositoryInterface;
use App\Repositories\Core\SourceBookRepositoryInterface;
use App\Repositories\Core\TechniqueSubtypeRepositoryInterface;
use App\Repositories\Core\TechniqueTypeRepositoryInterface;
use App\Repositories\RepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

final class ExportCoreDataCommand extends Command
{
    /** @inheritDoc */
    protected $name = 'data:export';

    /** @inheritDoc */
    protected $description = 'Export core data.';


    /**
     * @return bool
     */
    public function handle(
        SourceBookRepositoryInterface $sourceBooks,
        RingRepositoryInterface $rings,
        ItemTypeRepositoryInterface $itemTypes,
        ItemSubtypeRepositoryInterface $itemSubtypes,
        ItemRepositoryInterface $items,
        SkillGroupRepositoryInterface $skillGroups,
        SkillRepositoryInterface $skills,
        TechniqueSubtypeRepositoryInterface $techniqueSubtypes,
        TechniqueTypeRepositoryInterface $techniqueTypes,
        TechniqueRepositoryInterface $techniques,
        AdvantageTypeRepositoryInterface $advantageTypes,
        AdvantageRepositoryInterface $advantages,
        DisadvantageTypeRepositoryInterface $disadvantageTypes,
        DisadvantageRepositoryInterface $disadvantages,
        ClanRepositoryInterface $clans,
        FamilyRepositoryInterface $families,
        SchoolTypeRepositoryInterface $schoolTypes,
        SchoolRepositoryInterface $schools,
    ): bool {
        $this->create(SourceBook::class, $this->json($sourceBooks, ['key', 'name', 'image', 'is_official']));

        $this->create(Ring::class, $this->json($rings, ['key', 'name']));

        $this->create(ItemType::class, $this->json($itemTypes, ['key', 'name']));
        $this->create(ItemSubtype::class, $this->process($itemSubtypes, load: ['itemType'], data: [
            'item_type_key' => 'item_type.key',
            'name' => 'name',
            'key' => 'key',
        ]));

        $this->create(Item::class, $this->process($items, load: ['sourceBook', 'itemSubtype'], data: [
            'source_book_key' => 'source_book.key',
            'item_subtype_key' => 'item_subtype.key',
            'key' => 'key',
            'name' => 'name',
            'description' => 'description',
            'data' => 'data',
            'cost' => 'cost',
            'rarity' => 'rarity',
            'page_number' => 'page_number',
        ]));

        $this->create(SkillGroup::class, $this->json($skillGroups, ['key', 'name', 'description']));
        $this->create(Skill::class, $this->process($skills, load: ['skillGroup'], data: [
            'skill_group_key' => 'skill_group.key',
            'key' => 'key',
            'name' => 'name',
            'description' => 'description',
        ]));

        $this->create(TechniqueType::class, $this->json($techniqueTypes, ['key', 'name']));
        $this->create(TechniqueSubtype::class, $this->process($techniqueSubtypes, load: ['techniqueType'], data: [
            'technique_type_key' => 'technique_type.key',
            'key' => 'key',
            'name' => 'name',
        ]));

        $this->create(Technique::class, $this->process($techniques, load: ['sourceBook', 'techniqueSubtype'], data: [
            'source_book_key' => 'source_book.key',
            'technique_subtype_key' => 'technique_subtype.key',
            'key' => 'key',
            'name' => 'name',
            'rank' => 'rank',
            'description' => 'description',
            'page_number' => 'page_number',
        ]));

        $this->create(AdvantageType::class, $this->json($advantageTypes, ['key', 'name']));
        $this->create(Advantage::class, $this->process($advantages, load: ['sourceBook', 'advantageType', 'ring'], data: [
            'source_book_key' => 'source_book.key',
            'advantage_type_key' => 'advantage_type.key',
            'ring_key' => 'ring.key',
            'key' => 'key',
            'name' => 'name',
            'page_number' => 'page_number',
        ]));

        $this->create(DisadvantageType::class, $this->json($disadvantageTypes, ['key', 'name']));
        $this->create(Disadvantage::class, $this->process($disadvantages, load: ['sourceBook', 'disadvantageType', 'ring'], data: [
            'source_book_key' => 'source_book.key',
            'disadvantage_type_key' => 'disadvantage_type.key',
            'ring_key' => 'ring.key',
            'key' => 'key',
            'name' => 'name',
            'page_number' => 'page_number',
        ]));

        $this->create(Clan::class, $this->process($clans, load: ['sourceBook', 'ring', 'skill'], data: [
            'source_book_key' => 'source_book.key',
            'ring_key' => 'ring.key',
            'skill_key' => 'skill.key',
            'key' => 'key',
            'name' => 'name',
            'status' => 'status',
            'is_major' => 'is_major',
            'description' => 'description',
            'page_number' => 'page_number',
        ]));

        $this->create(Family::class, $this->process($families, load: [
            'sourceBook',
            'clan',
            'ringChoiceOne',
            'ringChoiceOne',
            'skillOne',
            'skillTwo',
        ], data: [
            'source_book_key' => 'source_book.key',
            'clan_key' => 'clan.key',
            'ring_choice_one_key' => 'ring_choice_one.key',
            'ring_choice_two_key' => 'ring_choice_two.key',
            'skill_one_key' => 'skill_one.key',
            'skill_two_key' => 'skill_two.key',
            'key' => 'key',
            'name' => 'name',
            'glory' => 'glory',
            'starting_wealth' => 'starting_wealth',
            'description' => 'description',
            'page_number' => 'page_number',
        ]));

        $this->create(SchoolType::class, $this->json($schoolTypes, ['key', 'name']));

        $this->create(School::class, $this->process($schools, load: [
            'sourceBook',
            'ringOne',
            'ringTwo',
            'family',
            'availableTechniqueTypes',
            'availableTechniqueSubtypes',
            'schoolTypes'
        ], data: [
            'source_book_key' => 'source_book.key',
            'ring_one_key' => 'ring_one.key',
            'ring_two_key' => 'ring_two.key',
            'family_key' => 'family.key',
            'available_technique_type_keys' => 'available_technique_types.*.key',
            'available_technique_subtype_keys' => 'available_technique_subtypes.*.key',
            'school_type_keys' => 'school_types.*.key',
            'name' => 'name',
            'key' => 'key',
            'honor' => 'honor',
            'starting_skill_amount' => 'starting_skill_amount',
            'starting_skills' => 'starting_skills',
            'starting_techniques' => 'starting_techniques',
            'starting_outfit' => 'starting_outfit',
            'curriculum' => 'curriculum',
            'page_number' => 'page_number'
        ]));

        return true;
    }


    private function create(string $model, string $data): void
    {
        $path = $this->path($model);
        $this->info('Model: ' . $model);
        $this->info('Path: ' . $path);
        $this->newLine();

        file_put_contents($this->path($model), $data);
    }


    /**
     * @param class-string<Model> $class
     *
     * @return string
     */
    private function path(string $class): string
    {
        $table =  (new $class())->getTable();

        return base_path('data/exports/core/' . $table . '.json');
    }


    private function all(RepositoryInterface $repository, array $columns = ['*'], array $load = []): Collection
    {
        $collection = $repository->bypassCache()->all($columns);
        if (!empty($load)) {
            $collection = $collection->load($load);
        }

        return $collection;
    }


    private function json(RepositoryInterface $repository, array $columns = ['*']): string
    {
        return json_encode($this->all($repository, $columns), JSON_PRETTY_PRINT);
    }


    private function process(RepositoryInterface $repository, array $columns = ['*'], array $load = [], array $data = []): string
    {
        $collection = $this->all($repository, $columns, $load);

        $output = [];
        foreach ($collection as $record) {
            $recordData = [];
            $record = $record->toArray();
            foreach ($data as $key => $value) {
                if (str_contains($value, '*')) {
                    $values = [];

                    $dot = Arr::dot($record);
                    foreach ($dot as $dotKey => $dotValue) {
                        if (preg_match("/{$value}/", $dotKey) === 1) {
                            $values[] = $dotValue;
                        }
                    }

                    $recordData[$key] = $values;
                    continue;
                }

                $recordData[$key] = Arr::get($record, $value);
            }

            $output[] = $recordData;
        }

        return json_encode($output, JSON_PRETTY_PRINT);
    }
}
