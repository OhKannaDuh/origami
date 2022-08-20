<?php

namespace Database\Seeders\SourceBooks\Core\Families;

use App\Models\Character\Family;
use Database\Seeders\SourceBooks\FamilySeeder;

final class CrabSeeder extends FamilySeeder
{


    public function run(): void
    {
        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('earth'),
            'ring_choice_two_id' => $this->getRingId('fire'),
            'skill_one_id' => $this->getSkillId('command'),
            'skill_two_id' => $this->getSkillId('tactics'),
            'key' => 'hida',
            'name' => 'Hida',
            'glory' => 44,
            'starting_wealth' => 4,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getsourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('water'),
            'skill_one_id' => $this->getSkillId('skulduggery'),
            'skill_two_id' => $this->getSkillId('survival'),
            'key' => 'hiruma',
            'name' => 'Hiruma',
            'glory' => 39,
            'starting_wealth' => 3,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getsourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('earth'),
            'ring_choice_two_id' => $this->getRingId('fire'),
            'skill_one_id' => $this->getSkillId('smithing'),
            'skill_two_id' => $this->getSkillId('labor'),
            'key' => 'kaiu',
            'name' => 'Kaiu',
            'glory' => 40,
            'starting_wealth' => 5,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getsourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('earth'),
            'ring_choice_two_id' => $this->getRingId('void'),
            'skill_one_id' => $this->getSkillId('medicine'),
            'skill_two_id' => $this->getSkillId('theology'),
            'key' => 'kuni',
            'name' => 'Kuni',
            'glory' => 40,
            'starting_wealth' => 5,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getsourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('water'),
            'skill_one_id' => $this->getSkillId('commerce'),
            'skill_two_id' => $this->getSkillId('design'),
            'key' => 'yasuki',
            'name' => 'Yasuki',
            'glory' => 39,
            'starting_wealth' => 10,
            'description' => '_',
        ]);
    }
}
