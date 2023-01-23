<?php

namespace Database\Seeders\Core;

use App\Models\Core\Ring;
use App\Repositories\Core\RingRepositoryInterface;
use Database\Seeders\Seeder;

final class RingSeeder extends Seeder
{


    public function run(RingRepositoryInterface $repository): void
    {
        $this->createFrom(Ring::class, $repository);
    }
}
