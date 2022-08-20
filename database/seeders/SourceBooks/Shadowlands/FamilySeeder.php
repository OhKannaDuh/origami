<?php

namespace Database\Seeders\SourceBooks\Shadowlands;

use App\Models\Character\Clan;
use App\Models\Character\Family;
use App\Models\Core\Ring;
use App\Models\Core\Skill;
use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

final class FamilySeeder extends Seeder
{
    /** @var Ring[] */
    private array $rings = [];

    /** @var Skill[] */
    private array $skills = [];


    public function run(SourceBook $sourceBook): void
    {
        $clan = Clan::query()->where('key', 'falcon')->first(['id']);

        Family::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'clan_id' => $clan->getKey(),
            'ring_choice_one_id' => $this->getRingId('earth'),
            'ring_choice_two_id' => $this->getRingId('water'),
            'skill_one_id' => $this->getSkillId('survival'),
            'skill_two_id' => $this->getSkillId('meditation'),
            'key' => 'toritaka',
            'name' => 'Toritaka',
            'glory' => 35,
            'starting_wealth' => 3,
            'description' => '_',
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
