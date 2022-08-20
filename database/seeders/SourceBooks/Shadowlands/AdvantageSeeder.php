<?php

namespace Database\Seeders\SourceBooks\Shadowlands;

use App\Models\Character\Advantage;
use App\Models\Core\AdvantageType;
use App\Models\Core\Ring;
use App\Models\Core\SourceBook;
use App\StringHelper;
use Illuminate\Database\Seeder;

final class AdvantageSeeder extends Seeder
{
    /** @var Ring[] */
    private array $rings = [];


    public function run(SourceBook $sourceBook): void
    {
        $this->createDistinction('Dead Eyes', 'earth', $sourceBook);
        $this->createDistinction('Friend of the Nezumi', 'water', $sourceBook);
        $this->createDistinction('Light Sleeper', 'water', $sourceBook);

        $this->createPassion('Creatures', 'fire', $sourceBook);
    }


    public function createDistinction(string $name, string $ring, SourceBook $sourceBook): Advantage
    {
        return Advantage::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'advantage_type_id' => AdvantageType::query()->where('key', 'distinction')->first(['id'])->getKey(),
            'ring_id' => $this->getRingId($ring),
            'key' => StringHelper::key($name),
            'name' => $name,
        ]);
    }


    public function createPassion(string $name, string $ring, SourceBook $sourceBook): Advantage
    {
        return Advantage::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'advantage_type_id' => AdvantageType::query()->where('key', 'passion')->first(['id'])->getKey(),
            'ring_id' => $this->getRingId($ring),
            'key' => StringHelper::key($name),
            'name' => $name,
        ]);
    }


    protected function getRingId(string $key): int
    {
        if (!array_key_exists($key, $this->rings)) {
            $this->rings[$key] = Ring::query()->where('key', $key)->first(['id']);
        }

        return $this->rings[$key]->getKey();
    }
}
