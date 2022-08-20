<?php

namespace Tests\Unit\Repositories\Core;

use App\Models\Core\Ring;
use App\Repositories\BaseRepository;
use App\Repositories\Core\RingRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class RingRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(RingRepository::class);
    }


    protected function getModelData(): array
    {
        return Ring::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return Ring::factory()->definition();
    }
}
