<?php

namespace Tests\Unit\Repositories\Character;

use App\Models\Core\DisadvantageType;
use App\Repositories\BaseRepository;
use App\Repositories\Core\DisadvantageTypeRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class DisadvantageTypeRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(DisadvantageTypeRepository::class);
    }


    protected function getModelData(): array
    {
        return DisadvantageType::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return DisadvantageType::factory()->definition();
    }
}
