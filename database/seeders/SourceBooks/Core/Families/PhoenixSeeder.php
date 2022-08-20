<?php

namespace Database\Seeders\SourceBooks\Core\Families;

use App\Models\Character\Family;
use Database\Seeders\SourceBooks\FamilySeeder;

final class PhoenixSeeder extends FamilySeeder
{


    public function run(): void
    {
        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('fire'),
            'skill_one_id' => $this->getSkillId('culture'),
            'skill_two_id' => $this->getSkillId('sentiment'),
            'key' => 'asako',
            'name' => 'Asako',
            'glory' => 40,
            'starting_wealth' => 5,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('fire'),
            'ring_choice_two_id' => $this->getRingId('void'),
            'skill_one_id' => $this->getSkillId('meditation'),
            'skill_two_id' => $this->getSkillId('theology'),
            'key' => 'isawa',
            'name' => 'Isawa',
            'glory' => 44,
            'starting_wealth' => 5,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('void'),
            'skill_one_id' => $this->getSkillId('fitness'),
            'skill_two_id' => $this->getSkillId('theology'),
            'key' => 'kaito',
            'name' => 'Kaito',
            'glory' => 40,
            'starting_wealth' => 4,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('earth'),
            'ring_choice_two_id' => $this->getRingId('water'),
            'skill_one_id' => $this->getSkillId('meditation'),
            'skill_two_id' => $this->getSkillId('tactics'),
            'key' => 'shiba',
            'name' => 'Shiba',
            'glory' => 40,
            'starting_wealth' => 5,
            'description' => '_',
        ]);
    }
}
