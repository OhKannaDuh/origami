<?php

namespace Database\Seeders\SourceBooks\Core\Families;

use App\Models\Character\Family;
use Database\Seeders\SourceBooks\FamilySeeder;

final class LionSeeder extends FamilySeeder
{


    public function run(): void
    {
        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('earth'),
            'skill_one_id' => $this->getSkillId('command'),
            'skill_two_id' => $this->getSkillId('government'),
            'key' => 'akodo',
            'name' => 'Akodo',
            'glory' => 44,
            'starting_wealth' => 5,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('water'),
            'skill_one_id' => $this->getSkillId('composition'),
            'skill_two_id' => $this->getSkillId('performance'),
            'key' => 'ikoma',
            'name' => 'Ikoma',
            'glory' => 40,
            'starting_wealth' => 5,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('void'),
            'ring_choice_two_id' => $this->getRingId('water'),
            'skill_one_id' => $this->getSkillId('meditation'),
            'skill_two_id' => $this->getSkillId('theology'),
            'key' => 'kitsu',
            'name' => 'Kitsu',
            'glory' => 40,
            'starting_wealth' => 4,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('earth'),
            'ring_choice_two_id' => $this->getRingId('fire'),
            'skill_one_id' => $this->getSkillId('command'),
            'skill_two_id' => $this->getSkillId('fitness'),
            'key' => 'matsu',
            'name' => 'Matsu',
            'glory' => 44,
            'starting_wealth' => 5,
            'description' => '_',
        ]);
    }
}
