<?php

namespace Tests\Unit\Repositories\Core;

use App\Models\Core\ItemSubtype;
use App\Repositories\BaseRepository;
use App\Repositories\Core\ItemSubtypeRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class ItemSubtypeRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(ItemSubtypeRepository::class);
    }


    protected function getModelData(): array
    {
        return ItemSubtype::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return ItemSubtype::factory()->definition();
    }
}
