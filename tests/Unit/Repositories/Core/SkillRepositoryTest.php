<?php

namespace Tests\Unit\Repositories\Core;

use App\Models\Core\Skill;
use App\Repositories\BaseRepository;
use App\Repositories\Core\SkillRepository;
use Illuminate\Support\Facades\App;
use Tests\Unit\Repositories\RepositoryTestCase;

final class SkillRepositoryTest extends RepositoryTestCase
{


    protected function getRepository(): BaseRepository
    {
        return App::make(SkillRepository::class);
    }


    protected function getModelData(): array
    {
        return Skill::factory()->definition();
    }


    protected function getUpdateData(): array
    {
        return Skill::factory()->definition();
    }
}
