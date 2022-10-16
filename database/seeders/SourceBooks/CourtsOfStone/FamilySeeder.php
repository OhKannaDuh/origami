<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone;

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
        $clan = Clan::query()->where('key', 'deer')->first(['id']);

        Family::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'clan_id' => $clan->getKey(),
            'ring_choice_one_id' => $this->getRingId('water'),
            'ring_choice_two_id' => $this->getRingId('fire'),
            'skill_one_id' => $this->getSkillId('courtesy'),
            'skill_two_id' => $this->getSkillId('culture'),
            'key' => 'shika',
            'name' => 'Shika',
            'glory' => 35,
            'starting_wealth' => 5,
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
