<?php

namespace Database\Seeders\SourceBooks\EmeraldEmpire;

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
        $clan = Clan::query()->where('key', 'imperial')->first(['id']);

        Family::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'clan_id' => $clan->getKey(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('earth'),
            'skill_one_id' => $this->getSkillId('courtesy'),
            'skill_two_id' => $this->getSkillId('culture'),
            'key' => 'miya',
            'name' => 'Miya',
            'glory' => 44,
            'starting_wealth' => 8,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'clan_id' => $clan->getKey(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('water'),
            'skill_one_id' => $this->getSkillId('culture'),
            'skill_two_id' => $this->getSkillId('sentiment'),
            'key' => 'otomo',
            'name' => 'Otomo',
            'glory' => 43,
            'starting_wealth' => 9,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'clan_id' => $clan->getKey(),
            'ring_choice_one_id' => $this->getRingId('earth'),
            'ring_choice_two_id' => $this->getRingId('void'),
            'skill_one_id' => $this->getSkillId('meditation'),
            'skill_two_id' => $this->getSkillId('theology'),
            'key' => 'seppun',
            'name' => 'Seppun',
            'glory' => 45,
            'starting_wealth' => 6,
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
