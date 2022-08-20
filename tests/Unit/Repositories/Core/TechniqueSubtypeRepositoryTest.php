<?php

namespace Tests\Unit\Repositories\Core;

use App\Models\Core\TechniqueSubtype;
use App\Repositories\BaseRepository;
use App\Repositories\Core\TechniqueSubtypeRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class TechniqueSubtypeRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(TechniqueSubtypeRepository::class);
    }


    protected function getModelData(): array
    {
        return TechniqueSubtype::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return TechniqueSubtype::factory()->definition();
    }
}
