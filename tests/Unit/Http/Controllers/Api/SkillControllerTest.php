<?php

namespace Tests\Unit\Http\Controllers\Api;

use App\Models\Core\Skill;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class SkillControllerTest extends TestCase
{


    public function testAll(): void
    {
        Skill::factory(28)->create();

        $this->get(route('api.skills.all'))
            ->assertJson(fn(AssertableJson $json) => $json->has('skills', 28));
    }
}
