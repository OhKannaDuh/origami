<?php

namespace Database\Seeders\SourceBooks\EmeraldEmpire;

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
        $this->createAdversity('Adopted Peasant', 'fire', $sourceBook);
        $this->createAdversity('Allergy [Choose One]', 'air', $sourceBook);
        $this->createAdversity('Cursed Lineage', 'void', $sourceBook);
        $this->createAdversity('Despised In [City]', 'water', $sourceBook);
        $this->createAdversity('Hunted by Chikusho-do', 'earth', $sourceBook);
        $this->createAdversity('Skepticism', 'void', $sourceBook);

        $this->createAnxiety('Accustomed to Luxury', 'earth', $sourceBook);
        $this->createAnxiety('Claustrophobia', 'water', $sourceBook);
        $this->createAnxiety('False Identity', 'air', $sourceBook);
        $this->createAnxiety('Loathing for Peasants', 'water', $sourceBook);
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
