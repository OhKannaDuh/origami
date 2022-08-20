<?php

namespace Tests\Unit\Repositories\Core;

use App\Models\Core\Campaign;
use App\Repositories\BaseRepository;
use App\Repositories\Core\CampaignRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class CampaignRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(CampaignRepository::class);
    }


    protected function getModelData(): array
    {
        return Campaign::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return Campaign::factory()->definition();
    }


    public function testGetByUuidd(): void
    {
        /** @var CampaignRepository $repository */
        $repository =  App::make(CampaignRepository::class);
        $model = $repository->import($this->getModelData());

        self::assertTrue($repository->getByUuid($model->uuid)->is($model));
    }
}
