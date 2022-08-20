<?php

namespace Tests\Unit\Repositories\Core;

use App\Models\Core\TechniqueType;
use App\Repositories\BaseRepository;
use App\Repositories\Core\TechniqueTypeRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class TechniqueTypeRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(TechniqueTypeRepository::class);
    }


    protected function getModelData(): array
    {
        return TechniqueType::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return TechniqueType::factory()->definition();
    }
}
