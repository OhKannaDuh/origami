<?php

namespace Database\Seeders\SourceBooks\Core\Families;

use App\Models\Character\Family;
use Database\Seeders\SourceBooks\FamilySeeder;

final class UnicornSeeder extends FamilySeeder
{


    public function run(): void
    {
        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('earth'),
            'ring_choice_two_id' => $this->getRingId('water'),
            'skill_one_id' => $this->getSkillId('commerce'),
            'skill_two_id' => $this->getSkillId('courtesy'),
            'key' => 'ide',
            'name' => 'Ide',
            'glory' => 40,
            'starting_wealth' => 9,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('air'),
            'ring_choice_two_id' => $this->getRingId('void'),
            'skill_one_id' => $this->getSkillId('meditation'),
            'skill_two_id' => $this->getSkillId('theology'),
            'key' => 'iuchi',
            'name' => 'Iuchi',
            'glory' => 40,
            'starting_wealth' => 5,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('earth'),
            'ring_choice_two_id' => $this->getRingId('fire'),
            'skill_one_id' => $this->getSkillId('command'),
            'skill_two_id' => $this->getSkillId('survival'),
            'key' => 'moto',
            'name' => 'Moto',
            'glory' => 40,
            'starting_wealth' => 6,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('fire'),
            'ring_choice_two_id' => $this->getRingId('water'),
            'skill_one_id' => $this->getSkillId('sentiment'),
            'skill_two_id' => $this->getSkillId('survival'),
            'key' => 'shinjo',
            'name' => 'Shinjo',
            'glory' => 44,
            'starting_wealth' => 8,
            'description' => '_',
        ]);

        Family::query()->create([
            'source_book_id' => $this->getSourceBookId(),
            'clan_id' => $this->getClanId(),
            'ring_choice_one_id' => $this->getRingId('earth'),
            'ring_choice_two_id' => $this->getRingId('fire'),
            'skill_one_id' => $this->getSkillId('survival'),
            'skill_two_id' => $this->getSkillId('tactics'),
            'key' => 'utaku',
            'name' => 'Utaku',
            'glory' => 44,
            'starting_wealth' => 6,
            'description' => '_',
        ]);
    }
}
