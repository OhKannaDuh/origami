<?php

namespace Tests\Unit\Models\Core;

use App\Models\Core\TechniqueSubtype;
use App\Models\Core\TechniqueType;
use Tests\TestCase;

final class TechniqueSubtypeTest extends TestCase
{


    public function testTechniqueTypeRelationship(): void
    {
        $type = TechniqueType::factory()->create();

        $subtype = TechniqueSubtype::factory()->create();
        $subtype->techniqueType()->associate($type);

        self::assertTrue($subtype->techniqueType->is($type));
    }
}
