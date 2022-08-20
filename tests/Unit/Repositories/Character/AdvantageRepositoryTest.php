<?php

namespace Tests\Unit\Repositories\Character;

use App\Models\Character\Advantage;
use App\Repositories\BaseRepository;
use App\Repositories\Character\AdvantageRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class AdvantageRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(AdvantageRepository::class);
    }


    protected function getModelData(): array
    {
        return Advantage::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return Advantage::factory()->definition();
    }
}
