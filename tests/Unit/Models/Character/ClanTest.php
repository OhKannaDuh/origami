<?php

namespace Tests\Unit\Models\Character;

use App\Models\Character\Clan;
use App\Models\Core\Ring;
use App\Models\Core\Skill;
use Tests\TestCase;

final class ClanTest extends TestCase
{


    public function testRingRelationship(): void
    {
        $ring = Ring::factory()->create();

        $clan = Clan::factory()->create();
        $clan->ring()->associate($ring);

        self::assertTrue($clan->ring->is($ring));
    }


    public function testSkillRelationship(): void
    {
        $skill = Skill::factory()->create();

        $clan = Clan::factory()->create();
        $clan->skill()->associate($skill);

        self::assertTrue($clan->skill->is($skill));
    }
}
