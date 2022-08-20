<?php

namespace Database\Seeders\SourceBooks\EmeraldEmpire;

use App\Models\Character\Clan;
use App\Models\Character\Family;
use App\Models\Character\Technique;
use App\Models\Core\Ring;
use App\Models\Core\Skill;
use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;
use App\StringHelper;
use Illuminate\Database\Seeder;

final class TechniqueSeeder extends Seeder
{
    /** @var Ring[] */
    private array $rings = [];

    /** @var Skill[] */
    private array $skills = [];


    public function run(SourceBook $sourceBook): void
    {
        $this->create('Spin the Web', 'air_shuji', 3, $sourceBook);
        $this->create('Awe of Heaven', 'void_shuji', 4, $sourceBook);
    }


    private function create(string $name, string $subtype, int $rank, SourceBook $sourceBook): Technique
    {
        return Technique::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'technique_subtype_id' => TechniqueSubtype::query()->where('key', $subtype)->first(['id'])->getKey(),
            'key' => StringHelper::key($name),
            'name' => $name,
            'rank' => $rank,
            'description' => '',
        ]);
    }


    protected function getRingId(string $key): int
    {
        if (!array_key_exists($key, $this->rings)) {
            $this->rings[$key] = Ring::query()->where('key', $key)->first(['id']);
        }

        return $this->rings[$key]->getKey();
    }


    protected function getSkillid(string $key): int
    {
        if (!array_key_exists($key, $this->skills)) {
            $this->skills[$key] = Skill::query()->where('key', $key)->first(['id']);
        }

        return $this->skills[$key]->getKey();
    }
}
