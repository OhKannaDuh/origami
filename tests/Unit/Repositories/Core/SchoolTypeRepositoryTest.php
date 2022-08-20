<?php

namespace Tests\Unit\Repositories\Core;

use App\Models\Core\SchoolType;
use App\Repositories\BaseRepository;
use App\Repositories\Core\SchoolTypeRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class SchoolTypeRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(SchoolTypeRepository::class);
    }


    protected function getModelData(): array
    {
        return SchoolType::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return SchoolType::factory()->definition();
    }
}
