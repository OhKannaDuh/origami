<?php

namespace Tests\Unit\Behaviours\Repositories;

use App\Repositories\Core\RingRepository;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

final class HasKeyedModelTest extends TestCase
{


    /**
     * Ensure we can get a model by key.
     */
    public function testGetByKey1(): void
    {
        /** @var RingRepository $rings */
        $rings = App::make(RingRepository::class);
        $ring = $rings->create([
            'key' => 'test',
            'name' => 'Test',
        ]);

        self::assertTrue($rings->getByKey('test')->is($ring));
    }


    /**
     * Ensure we can get a model by key.
     */
    public function testGetByKey2(): void
    {
        /** @var RingRepository $rings */
        $rings = App::make(RingRepository::class);

        $rings->create([
            'key' => 'test',
            'name' => 'Test',
        ]);

        $other = $rings->create([
            'key' => 'other',
            'name' => 'Other',
        ]);

        self::assertTrue($rings->getByKey('other')->is($other));
    }


    /**
     * Ensure we can check a key exists
     */
    public function testKeyExists(): void
    {
        /** @var RingRepository $rings */
        $rings = App::make(RingRepository::class);

        $rings->create([
            'key' => 'test',
            'name' => 'Test',
        ]);

        $rings->create([
            'key' => 'other',
            'name' => 'Other',
        ]);

        self::assertTrue($rings->keyExists('test'));
        self::assertTrue($rings->keyExists('other'));
        self::assertFalse($rings->keyExists('another'));
    }
}
