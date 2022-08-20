<?php

namespace Tests\Unit\Http\Controllers\SourceBook;

use App\Models\Core\SourceBook;
use App\Models\User;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

use function PHPUnit\Framework\assertIsArray;

final class IndexControllerTest extends TestCase
{


    private function hit(): TestResponse
    {
        return $this->get(route('source-book.index.show'));
    }


    public function testShowGuest(): void
    {
        SourceBook::factory(12)->create();

        $response = $this->hit();
        $response->assertOk();
        $response->assertInertia(function (AssertableInertia $assert) {
            $assert->component('SourceBook/Index');
            $assert->count('books', 12);

            $books = $assert->toArray()['props']['books'];
            self::assertIsArray($books);
            foreach ($books as $book) {
                self::assertIsArray($book);
                self::assertArrayHasKey('clans_count', $book);
                self::assertArrayHasKey('families_count', $book);
                self::assertArrayHasKey('techniques_count', $book);
                self::assertArrayHasKey('items_count', $book);
                self::assertArrayHasKey('schools_count', $book);
                self::assertArrayHasKey('advantages_count', $book);
                self::assertArrayHasKey('disadvantages_count', $book);
            }
        });
    }


    public function testShowAuthUser(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        SourceBook::factory(28)->create();

        $response = $this->hit();
        $response->assertOk();
        $response->assertInertia(function (AssertableInertia $assert) {
            $assert->component('SourceBook/Index');
            $assert->count('books', 28);
        });
    }
}
