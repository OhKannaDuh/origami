<?php

namespace Database\Seeders\SourceBooks;

use App\Models\Character\Clan;
use App\Models\Core\Ring;
use App\Models\Core\Skill;
use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

abstract class FamilySeeder extends Seeder
{
    /** @var Ring[] */
    private array $rings = [];

    /** @var Skill[] */
    private array $skills = [];


    public function __construct(
        private SourceBook $sourcebook,
        private Clan $clan,
    ) {
    }


    protected function getSourceBookId(): int
    {
        return $this->sourcebook->getKey();
    }


    protected function getClanId(): int
    {
        return $this->clan->getKey();
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
