<?php

namespace Database\Seeders\SourceBooks;

use App\Models\Character\Technique;
use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;
use App\StringHelper;
use Illuminate\Database\Seeder;

abstract class TechniqueSeeder extends Seeder
{


    public function __construct(
        private SourceBook $sourceBook,
        private TechniqueSubtype $type,
    ) {
    }


    protected function getSourceBookId(): int
    {
        return $this->sourceBook->getKey();
    }


    protected function getTypeId(): int
    {
        return $this->type->getKey();
    }


    protected function create(string $name, int $rank = 1, string $description = '_'): Technique
    {
        return Technique::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'technique_subtype_id' => $this->getTypeId(),
            'key' => StringHelper::key($name),
            'name' => $name,
            'rank' => $rank,
            'description' => $description,
        ]);
    }
}
