<?php

namespace Database\Seeders\Character;

use App\Models\Character\Family;
use App\Repositories\Character\ClanRepositoryInterface;
use App\Repositories\Character\FamilyRepositoryInterface;
use App\Repositories\Core\RingRepositoryInterface;
use App\Repositories\Core\SkillRepositoryInterface;
use App\Repositories\Core\SourceBookRepositoryInterface;
use Database\Seeders\Seeder;
use Illuminate\Support\Arr;

final class FamilySeeder extends Seeder
{


    public function run(
        FamilyRepositoryInterface $repository,
        SourceBookRepositoryInterface $sourceBooks,
        ClanRepositoryInterface $clans,
        RingRepositoryInterface $rings,
        SkillRepositoryInterface $skills,
    ): void {
        $data = $this->getData(Family::class);

        foreach ($data as $datum) {
            $sourceBook = $sourceBooks->getByKey($datum['source_book']['key']);
            $clan = $clans->getByKey($datum['clan']['key']);
            $ringOne = $rings->getByKey($datum['ring_choice_one']['key']);
            $ringTwo = $rings->getByKey($datum['ring_choice_two']['key']);
            $skillOne = $skills->getByKey($datum['skill_one']['key']);
            $skillTwo = $skills->getByKey($datum['skill_two']['key']);

            $create = Arr::only($datum, ['key', 'name', 'glory', 'starting_wealth', 'description', 'page_number']);
            $create['source_book_id'] = $sourceBook->getKey();
            $create['clan_id'] = $clan->getKey();
            $create['ring_choice_one_id'] = $ringOne->getKey();
            $create['ring_choice_two_id'] = $ringTwo->getKey();
            $create['skill_one_id'] = $skillOne->getKey();
            $create['skill_two_id'] = $skillTwo->getKey();

            $repository->create($create);
        }
    }
}
