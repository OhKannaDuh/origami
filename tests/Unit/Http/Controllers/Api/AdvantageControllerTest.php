<?php

namespace Tests\Unit\Http\Controllers\Api;

use App\Models\Character\Advantage;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class AdvantageControllerTest extends TestCase
{


    public function testAll(): void
    {
        Advantage::factory(3)->create();

        $this->get(route('api.advantages.all'))
            ->assertJson(function (AssertableJson $json) {
                $json->has('advantages', 3);
                $advantages = $json->toArray()['advantages'];
                self::assertIsArray($advantages);

                foreach ($advantages as $advantage) {
                    self::assertIsArray($advantage);
                    self::assertArrayHasKey('advantage_type', $advantage);
                }
            });
    }
}
