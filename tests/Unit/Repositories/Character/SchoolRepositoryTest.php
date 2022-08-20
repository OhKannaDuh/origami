<?php

namespace Tests\Unit\Repositories\Character;

use App\Models\Character\School;
use App\Repositories\BaseRepository;
use App\Repositories\Character\SchoolRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class SchoolRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(SchoolRepository::class);
    }


    protected function getModelData(): array
    {
        return School::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return School::factory()->definition();
    }
}
