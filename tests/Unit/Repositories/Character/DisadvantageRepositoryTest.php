<?php

namespace Tests\Unit\Repositories\Character;

use App\Models\Character\Disadvantage;
use App\Repositories\BaseRepository;
use App\Repositories\Character\DisadvantageRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class DisadvantageRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(DisadvantageRepository::class);
    }


    protected function getModelData(): array
    {
        return Disadvantage::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return Disadvantage::factory()->definition();
    }
}
