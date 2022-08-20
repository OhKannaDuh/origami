<?php

namespace Tests\Unit\Repositories\Core;

use App\Models\Core\SkillGroup;
use App\Repositories\BaseRepository;
use App\Repositories\Core\SkillGroupRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class SkillGroupRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(SkillGroupRepository::class);
    }


    protected function getModelData(): array
    {
        return SkillGroup::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return SkillGroup::factory()->definition();
    }
}
