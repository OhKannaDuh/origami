<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone;

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
        $this->createDistinction('Affect Of Harmlessness', 'air', $sourceBook);
        $this->createDistinction('Famously Neutral', 'earth', $sourceBook);
        $this->createDistinction('Well Connected in [City]', 'water', $sourceBook);

        $this->createPassion('Decorum', 'water', $sourceBook);
        $this->createPassion('Local Flare for [Region]', 'earth', $sourceBook);
        $this->createPassion('Pot Stirrer', 'fire', $sourceBook);
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
