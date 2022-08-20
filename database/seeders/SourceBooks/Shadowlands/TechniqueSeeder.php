<?php

namespace Database\Seeders\SourceBooks\Shadowlands;

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
        $this->create('Essence of Jade', 'earth_invocations', 3, $sourceBook);
        $this->create('Blessing of Steel', 'rituals', 2, $sourceBook);
        $this->create('Craft Shikigami', 'rituals', 2, $sourceBook);
        $this->create('Accursed Summoning', 'maho', 1, $sourceBook);
        $this->create('Bind the Undead', 'maho', 2, $sourceBook);
        $this->create('Commune with Evil', 'maho', 1, $sourceBook);
        $this->create('Dark Reflection', 'maho', 1, $sourceBook);
        $this->create('Entreat the Shadow Steed', 'maho', 2, $sourceBook);
        $this->create('Fiend\s Retreat', 'maho', 3, $sourceBook);
        $this->create('Shape the Flesh', 'maho', 4, $sourceBook);
        $this->create('Spiritual Shackles', 'maho', 1, $sourceBook);
        $this->create('Spread Corruption', 'maho', 2, $sourceBook);
        $this->create('Sword of Blood', 'maho', 2, $sourceBook);
        $this->create('Twisted Summons', 'maho', 3, $sourceBook);
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
