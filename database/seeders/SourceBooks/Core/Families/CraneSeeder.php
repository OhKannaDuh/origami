<?php

namespace Database\Seeders\SourceBooks\Core\Families;

use App\Models\Character\Family;
use Database\Seeders\SourceBooks\FamilySeeder;

final class CraneSeeder extends FamilySeeder
{


    public function run(): void
    {
        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('water'),
            'ring_choice_two_id' => $this->getRingId('void'),
            'skill_one_id' => $this->getSkillId('aesthetics'),
            'skill_two_id' => $this->getSkillId('theology'),
            'key' => 'asahina',
            'name' => 'Asahina',
            'glory' => 40,
            'starting_wealth' => 6,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('earth'),
            'ring_choice_two_id' => $this->getRingId('water'),
            'skill_one_id' => $this->getSkillId('fitness'),
            'skill_two_id' => $this->getSkillId('tactics'),
            'key' => 'daidoji',
            'name' => 'Daidoji',
            'glory' => 40,
            'starting_wealth' => 7,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('water'),
            'skill_one_id' => $this->getSkillId('courtesy'),
            'skill_two_id' => $this->getSkillId('design'),
            'key' => 'doji',
            'name' => 'Doji',
            'glory' => 44,
            'starting_wealth' => 8,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('fire'),
            'skill_one_id' => $this->getSkillId('aesthetics'),
            'skill_two_id' => $this->getSkillId('meditation'),
            'key' => 'kakita',
            'name' => 'Kakita',
            'glory' => 44,
            'starting_wealth' => 7,
            'description' => '_',
        ]);
    }
}
