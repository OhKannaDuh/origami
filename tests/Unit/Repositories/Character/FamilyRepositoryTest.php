<?php

namespace Tests\Unit\Repositories\Character;

use App\Models\Character\Family;
use App\Repositories\BaseRepository;
use App\Repositories\Character\FamilyRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class FamilyRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(FamilyRepository::class);
    }


    protected function getModelData(): array
    {
        return Family::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return Family::factory()->definition();
    }
}
