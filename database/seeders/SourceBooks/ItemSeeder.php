<?php

namespace Database\Seeders\SourceBooks;

use App\Models\Character\Item;
use App\Models\Core\ItemSubtype;
use App\Models\Core\SourceBook;
use App\StringHelper;
use Database\Seeders\Helpers\Cost;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Seeder;

abstract class ItemSeeder extends Seeder
{


    public function __construct(
        private SourceBook $sourceBook,
        private ItemSubtype $subtype
    ) {
    }


    protected function getSourceBookId(): int
    {
        return $this->sourceBook->getKey();
    }


    public function create(string $name, int $rarity, Cost $cost, Arrayable $data = null): void
    {
        Item::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'item_subtype_id' => $this->subtype->getKey(),
            'key' => StringHelper::key($name),
            'name' => $name,
            'description' => '_',
            'data' => $data?->toArray() ?? [],
            'cost' => $cost->toArray(),
            'rarity' => $rarity,
        ]);
    }
}
