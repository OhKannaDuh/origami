<?php

namespace Tests\Unit\Http\Controllers\Api;

use App\Models\Character\Disadvantage;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class DisadvantageControllerTest extends TestCase
{


    public function testAll(): void
    {
        Disadvantage::factory(45)->create();

        $this->get(route('api.disadvantages.all'))
            ->assertJson(function (AssertableJson $json) {
                $json->has('disadvantages', 45);
                $disadvantages = $json->toArray()['disadvantages'];
                self::assertIsArray($disadvantages);

                foreach ($disadvantages as $disadvantage) {
                    self::assertIsArray($disadvantage);
                    self::assertArrayHasKey('disadvantage_type', $disadvantage);
                }
            });
    }
}
