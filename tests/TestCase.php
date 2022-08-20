<?php

namespace Tests;

use App\StringHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use LazilyRefreshDatabase;


    public function setUp(): void
    {
        parent::setUp();

        // Don't persist cache and sessions between tests
        Cache::flush();
        Session::flush();
    }


    protected static function assertRelationshipCount(int $expectedCount, Model $model, string $related): void
    {
        $class = StringHelper::afterLast(get_class($model), '\\');
        if (!$model->isRelation($related)) {
            self::fail('The relationship ' . $related . ' does not exist on ' . $class);
        }

        $model->load($related);
        self::assertCount($expectedCount, $model->$related);
    }
}
