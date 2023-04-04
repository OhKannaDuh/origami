<?php

namespace Database\Seeders\Character;

use App\Models\Character\Clan;
use App\Repositories\Character\ClanRepositoryInterface;
use App\Repositories\Core\RingRepositoryInterface;
use App\Repositories\Core\SkillRepositoryInterface;
use App\Repositories\Core\SourceBookRepositoryInterface;
use Database\Seeders\Seeder;
use Illuminate\Support\Arr;

final class ClanSeeder extends Seeder
{


    public function run(
        ClanRepositoryInterface $repository,
        SourceBookRepositoryInterface $sourceBooks,
        RingRepositoryInterface $rings,
        SkillRepositoryInterface $skills,
    ): void {
        $data = $this->getData(Clan::class);

        foreach ($data as $datum) {
            $sourceBook = $sourceBooks->getByKey($datum['source_book']['key']);
            $ring = $rings->getByKey($datum['ring']['key']);
            $skill = $skills->getByKey($datum['skill']['key']);

            $create = Arr::only($datum, ['key', 'name', 'status', 'is_major', 'description', 'page_number']);
            $create['source_book_id'] = $sourceBook->getKey();
            $create['ring_id'] = $ring->getKey();
            $create['skill_id'] = $skill->getKey();

            $repository->create($create);
        }
    }
}
