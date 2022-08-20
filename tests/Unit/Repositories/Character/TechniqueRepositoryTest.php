<?php

namespace Tests\Unit\Repositories\Character;

use App\Models\Character\Technique;
use App\Repositories\BaseRepository;
use App\Repositories\Character\TechniqueRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class TechniqueRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(TechniqueRepository::class);
    }


    protected function getModelData(): array
    {
        return Technique::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return Technique::factory()->definition();
    }
}
