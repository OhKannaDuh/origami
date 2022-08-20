<?php

namespace Database\Seeders\SourceBooks\Shadowlands;

use App\Models\Character\Disadvantage;
use App\Models\Core\DisadvantageType;
use App\Models\Core\Ring;
use App\Models\Core\SourceBook;
use App\StringHelper;
use Illuminate\Database\Seeder;

final class DisadvantageSeeder extends Seeder
{
    /** @var Ring[] */
    private array $rings = [];


    public function run(SourceBook $sourceBook): void
    {
        $this->createAdversity('Demon Wound', 'fire', $sourceBook);
        $this->createAdversity('Lost Name', 'void', $sourceBook);

        $this->createAnxiety('Fallen Ancestor', 'void', $sourceBook);
        $this->createAnxiety('Obtuse', 'air', $sourceBook);
        $this->createAnxiety('Reformed Maho-Tsukai', 'water', $sourceBook);
    }


    public function createAdversity(string $name, string $ring, SourceBook $sourceBook): Disadvantage
    {
        return Disadvantage::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'disadvantage_type_id' => DisadvantageType::query()->where('key', 'adversity')->first(['id'])->getKey(),
            'ring_id' => $this->getRingId($ring),
            'key' => StringHelper::key($name),
            'name' => $name,
        ]);
    }


    public function createAnxiety(string $name, string $ring, SourceBook $sourceBook): Disadvantage
    {
        return Disadvantage::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'disadvantage_type_id' => DisadvantageType::query()->where('key', 'anxiety')->first(['id'])->getKey(),
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
