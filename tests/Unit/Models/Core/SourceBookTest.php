<?php

namespace Tests\Unit\Models\Core;

use App\Models\Character\Advantage;
use App\Models\Character\Clan;
use App\Models\Character\Disadvantage;
use App\Models\Character\Family;
use App\Models\Character\Item;
use App\Models\Character\School;
use App\Models\Character\Technique;
use App\Models\Core\Skill;
use App\Models\Core\SkillGroup;
use App\Models\Core\SourceBook;
use Tests\TestCase;

final class SourceBookTest extends TestCase
{


    public function testClansRelationship(): void
    {
        $book = SourceBook::factory()->create();
        self::assertEmpty($book->clans);

        for ($i = 0; $i < 2; $i++) {
            Clan::factory()->create([
                'source_book_id' => $book->getKey(),
            ]);
        }

        $book->load('clans');
        self::assertCount(2, $book->clans);
    }


    public function testFamiliesRelationship(): void
    {
        $book = SourceBook::factory()->create();
        self::assertEmpty($book->families);

        for ($i = 0; $i < 3; $i++) {
            Family::factory()->create([
                'source_book_id' => $book->getKey(),
            ]);
        }

        $book->load('families');
        self::assertCount(3, $book->families);
    }


    public function testTechniquesRelationship(): void
    {
        $book = SourceBook::factory()->create();
        self::assertEmpty($book->techniques);

        for ($i = 0; $i < 12; $i++) {
            Technique::factory()->create([
                'source_book_id' => $book->getKey(),
            ]);
        }

        $book->load('techniques');
        self::assertCount(12, $book->techniques);
    }


    public function testItemsRelationship(): void
    {
        $book = SourceBook::factory()->create();
        self::assertEmpty($book->items);

        for ($i = 0; $i < 5; $i++) {
            Item::factory()->create([
                'source_book_id' => $book->getKey(),
            ]);
        }

        $book->load('items');
        self::assertCount(5, $book->items);
    }


    public function testSchoolsRelationship(): void
    {
        $book = SourceBook::factory()->create();
        self::assertEmpty($book->schools);

        School::factory()->create([
            'source_book_id' => $book->getKey(),
        ]);

        $book->load('schools');
        self::assertCount(1, $book->schools);
    }


    public function testAdvantagesRelationship(): void
    {
        $book = SourceBook::factory()->create();
        self::assertEmpty($book->advantages);

        for ($i = 0; $i < 3; $i++) {
            Advantage::factory()->create([
                'source_book_id' => $book->getKey(),
            ]);
        }

        $book->load('advantages');
        self::assertCount(3, $book->advantages);
    }


    public function testDisadvantagesRelationship(): void
    {
        $book = SourceBook::factory()->create();
        self::assertEmpty($book->disadvantages);

        for ($i = 0; $i < 6; $i++) {
            Disadvantage::factory()->create([
                'source_book_id' => $book->getKey(),
            ]);
        }

        $book->load('disadvantages');
        self::assertCount(6, $book->disadvantages);
    }
}
