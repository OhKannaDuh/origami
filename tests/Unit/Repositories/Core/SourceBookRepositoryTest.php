<?php

namespace Tests\Unit\Repositories\Core;

use App\Models\Core\SourceBook;
use App\Repositories\BaseRepository;
use App\Repositories\Core\SourceBookRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class SourceBookRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(SourceBookRepository::class);
    }


    protected function getModelData(): array
    {
        return SourceBook::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return SourceBook::factory()->definition();
    }
}
