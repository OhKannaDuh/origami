<?php

namespace Tests\Unit\Repositories\Core;

use App\Models\Core\ItemType;
use App\Repositories\BaseRepository;
use App\Repositories\Core\ItemTypeRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class ItemTypeRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(ItemTypeRepository::class);
    }


    protected function getModelData(): array
    {
        return ItemType::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return ItemType::factory()->definition();
    }
}
