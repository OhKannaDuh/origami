<?php

namespace Database\Seeders\SourceBooks;

use App\Models\Character\Advantage;
use App\Models\Core\AdvantageType;
use App\Models\Core\Ring;
use App\Models\Core\SourceBook;
use App\StringHelper;
use Illuminate\Database\Seeder;

abstract class AdvantageSeeder extends Seeder
{
    /** @var Ring[] */
    private array $rings = [];


    public function __construct(
        private SourceBook $sourcebook,
        private AdvantageType $type,
    ) {
    }


    protected function getSourceBookId(): int
    {
        return $this->sourcebook->getKey();
    }


    protected function getAdvantageTypeId(): int
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


    protected function create(string $name, string $ring): Advantage
    {
        return Advantage::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'advantage_type_id' => $this->getAdvantageTypeId(),
            'ring_id' => $this->getRingId($ring),
            'key' => StringHelper::key($name),
            'name' => $name,
        ]);
    }
}
