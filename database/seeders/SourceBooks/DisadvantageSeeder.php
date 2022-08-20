<?php

namespace Database\Seeders\SourceBooks;

use App\Models\Character\Disadvantage;
use App\Models\Core\DisadvantageType;
use App\Models\Core\Ring;
use App\Models\Core\SourceBook;
use App\StringHelper;
use Illuminate\Database\Seeder;

abstract class DisadvantageSeeder extends Seeder
{
    /** @var Ring[] */
    private array $rings = [];


    public function __construct(
        private SourceBook $sourcebook,
        private DisadvantageType $type,
    ) {
    }


    protected function getSourceBookId(): int
    {
        return $this->sourcebook->getKey();
    }


    protected function getDisadvantageTypeId(): int
    {
        return $this->type->getKey();
    }


    protected function getRingId(string $key): int
    {
        if (!array_key_exists($key, $this->rings)) {
            $this->rings[$key] = Ring::query()->where('key', $key)->first(['id']);
        }

        return $this->rings[$key]->getKey();
    }


    protected function create(string $name, string $ring): Disadvantage
    {
        return Disadvantage::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'disadvantage_type_id' => $this->getDisadvantageTypeId(),
            'ring_id' => $this->getRingId($ring),
            'key' => StringHelper::key($name),
            'name' => $name,
        ]);
    }
}
