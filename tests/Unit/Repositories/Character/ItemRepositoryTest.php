<?php

namespace Tests\Unit\Repositories\Character;

use App\Models\Character\Item;
use App\Repositories\BaseRepository;
use App\Repositories\Character\ItemRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class ItemRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(ItemRepository::class);
    }


    protected function getModelData(): array
    {
        return Item::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return Item::factory()->definition();
    }
}
