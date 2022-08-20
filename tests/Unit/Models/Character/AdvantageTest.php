<?php

namespace Tests\Unit\Models\Character;

use App\Models\Character\Advantage;
use App\Models\Core\AdvantageType;
use App\Models\Core\Ring;
use Tests\TestCase;

final class AdvantageTest extends TestCase
{


    public function testAdvantageTypeRelationship(): void
    {
        $type = AdvantageType::factory()->create();

        $advantage = Advantage::factory()->create();
        $advantage->advantageType()->associate($type);

        self::assertTrue($advantage->advantageType->is($type));
    }


    public function testRingRelationship(): void
    {
        $ring = Ring::factory()->create();

        $advantage = Advantage::factory()->create();
        $advantage->ring()->associate($ring);

        self::assertTrue($advantage->ring->is($ring));
    }
}
