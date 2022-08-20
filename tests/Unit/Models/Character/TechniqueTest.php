<?php

namespace Tests\Unit\Models\Character;

use App\Models\Character\Technique;
use App\Models\Core\TechniqueSubtype;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

final class TechniqueTest extends TestCase
{


    public function testTechniqueSubtypeRelationship(): void
    {
        $type = TechniqueSubtype::factory()->create();

        $technique = Technique::factory()->create([
            'technique_subtype_id' => $type->getKey(),
        ]);

        self::assertTrue($technique->techniqueSubtype->is($type));
        self::assertInstanceOf(BelongsTo::class, $technique->techniqueSubtype());
    }
}
