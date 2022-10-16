<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone;

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
        $this->createAdversity('Overconfidence in Charm', 'water', $sourceBook);
        $this->createAdversity('Overconfidence in Creativity', 'fire', $sourceBook);
        $this->createAdversity('Overconfidence in Toughness', 'earth', $sourceBook);
        $this->createAdversity('Overconfidence in Sensitivity', 'void', $sourceBook);
        $this->createAdversity('Overconfidence in Subtlety', 'air', $sourceBook);
        $this->createAdversity('Lackluster', 'fire', $sourceBook);
        $this->createAdversity('Unsavory Past', 'water', $sourceBook);

        $this->createAnxiety('Isolation', 'earth', $sourceBook);
        $this->createAnxiety('Web of Lies', 'air', $sourceBook);
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
