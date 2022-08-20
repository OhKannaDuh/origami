<?php

namespace Tests\Unit\Repositories\Character;

use App\Models\Character\Character;
use App\Repositories\BaseRepository;
use App\Repositories\Character\CharacterRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class CharacterRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(CharacterRepository::class);
    }


    protected function getModelData(): array
    {
        return Character::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return Character::factory()->definition();
    }


    public function testGetByUuidd(): void
    {
        /** @var CharacterRepository $repository */
        $repository =  App::make(CharacterRepository::class);
        $model = $repository->import($this->getModelData());

        self::assertTrue($repository->getByUuid($model->uuid)->is($model));
    }
}
