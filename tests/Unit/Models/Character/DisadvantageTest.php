<?php

namespace Tests\Unit\Models\Character;

use App\Models\Character\Disadvantage;
use App\Models\Core\DisadvantageType;
use App\Models\Core\Ring;
use Tests\TestCase;

final class DisadvantageTest extends TestCase
{


    public function testDisadvantageTypeRelationship(): void
    {
        $type = DisadvantageType::factory()->create();

        $disadvantage = Disadvantage::factory()->create();
        $disadvantage->disadvantageType()->associate($type);

        self::assertTrue($disadvantage->disadvantageType->is($type));
    }


    public function testRingRelationship(): void
    {
        $ring = Ring::factory()->create();

        $disadvantage = Disadvantage::factory()->create();
        $disadvantage->ring()->associate($ring);

        self::assertTrue($disadvantage->ring->is($ring));
    }
}
