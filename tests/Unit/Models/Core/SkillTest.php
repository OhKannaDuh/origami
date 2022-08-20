<?php

namespace Tests\Unit\Models\Core;

use App\Models\Core\Skill;
use App\Models\Core\SkillGroup;
use Tests\TestCase;

final class SkillTest extends TestCase
{


    public function testSkillGroupRelationship(): void
    {
        $group = SkillGroup::factory()->create();

        $skill = Skill::factory()->create();
        $skill->skillGroup()->associate($group);

        self::assertTrue($skill->skillGroup->is($group));
    }
}
