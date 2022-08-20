<?php

namespace Tests\Unit\Repositories\Character;

use App\Models\Character\Clan;
use App\Repositories\BaseRepository;
use App\Repositories\Character\ClanRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class ClanRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(ClanRepository::class);
    }


    protected function getModelData(): array
    {
        return Clan::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return Clan::factory()->definition();
    }
}
