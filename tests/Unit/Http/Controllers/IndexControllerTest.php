<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\Core\SourceBook;
use App\Models\User;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

final class IndexControllerTest extends TestCase
{


    private function hit(): TestResponse
    {
        return $this->get(route('index.show'));
    }


    public function testShowGuest(): void
    {
        $response = $this->hit();
        $response->assertOk();
        $response->assertInertia(fn (AssertableInertia $assert) => $assert->component('Index'));
    }


    public function testShowAuthUser(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $response = $this->hit();
        $response->assertOk();
        $response->assertInertia(fn (AssertableInertia $assert) => $assert->component('Index'));
    }
}
