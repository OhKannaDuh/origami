<?php

namespace Tests\Unit\Repositories\Character;

use App\Models\Core\AdvantageType;
use App\Repositories\BaseRepository;
use App\Repositories\Core\AdvantageTypeRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class AdvantageTypeRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(AdvantageTypeRepository::class);
    }


    protected function getModelData(): array
    {
        return AdvantageType::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return AdvantageType::factory()->definition();
    }
}
