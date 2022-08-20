<?php

namespace Database\Seeders\SourceBooks\Core\Families;

use App\Models\Character\Family;
use Database\Seeders\SourceBooks\FamilySeeder;

final class ScorpionSeeder extends FamilySeeder
{


    public function run(): void
    {
        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('fire'),
            'skill_one_id' => $this->getSkillId('courtesy'),
            'skill_two_id' => $this->getSkillId('design'),
            'key' => 'bayushi',
            'name' => 'Bayushi',
            'glory' => 44,
            'starting_wealth' => 8,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('water'),
            'skill_one_id' => $this->getSkillId('courtesy'),
            'skill_two_id' => $this->getSkillId('performance'),
            'key' => 'shosuro',
            'name' => 'Shosuro',
            'glory' => 40,
            'starting_wealth' => 6,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('void'),
            'skill_one_id' => $this->getSkillId('design'),
            'skill_two_id' => $this->getSkillId('theology'),
            'key' => 'soshi',
            'name' => 'Soshi',
            'glory' => 40,
            'starting_wealth' => 6,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('earth'),
            'ring_choice_two_id' => $this->getRingId('void'),
            'skill_one_id' => $this->getSkillId('composition'),
            'skill_two_id' => $this->getSkillId('theology'),
            'key' => 'yogo',
            'name' => 'Yogo',
            'glory' => 39,
            'starting_wealth' => 4,
            'description' => '_',
        ]);
    }
}
