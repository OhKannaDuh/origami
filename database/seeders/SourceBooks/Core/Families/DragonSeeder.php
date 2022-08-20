<?php

namespace Database\Seeders\SourceBooks\Core\Families;

use App\Models\Character\Family;
use Database\Seeders\SourceBooks\FamilySeeder;

final class DragonSeeder extends FamilySeeder
{


    public function run(): void
    {
        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('fire'),
            'ring_choice_two_id' => $this->getRingId('void'),
            'skill_one_id' => $this->getSkillId('medicine'),
            'skill_two_id' => $this->getSkillId('smithing'),
            'key' => 'agasha',
            'name' => 'Agasha',
            'glory' => 40,
            'starting_wealth' => 4,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('water'),
            'skill_one_id' => $this->getSkillId('government'),
            'skill_two_id' => $this->getSkillId('sentiment'),
            'key' => 'kitsuki',
            'name' => 'Kisuki',
            'glory' => 44,
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
            'key' => 'mirumoto',
            'name' => 'Mirumoto',
            'glory' => 44,
            'starting_wealth' => 5,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('earth'),
            'ring_choice_two_id' => $this->getRingId('void'),
            'skill_one_id' => $this->getSkillId('fitness'),
            'skill_two_id' => $this->getSkillId('theology'),
            'key' => 'togashi',
            'name' => 'Togashi',
            'glory' => 45,
            'starting_wealth' => 3,
            'description' => '_',
        ]);
    }
}
