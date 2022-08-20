<?php

namespace Tests\Unit\Repositories;

use App\Models\Character\Character;
use App\Repositories\BaseRepository;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

abstract class RepositoryTestCase extends TestCase
{
    use LazilyRefreshDatabase;


    abstract protected function getRepository(): BaseRepository;


    abstract protected function getModelData(): array;


    abstract protected function getUpdateData(): array;


    protected function getAdditionalCreateData(): array
    {
        return [];
    }


    protected function getSkipModelComparisonKeys(): array
    {
        return [];
    }


    public function testGetById(): void
    {
        $repository = $this->getRepository();
        $model = $repository->import($this->getModelData());

        self::assertTrue($repository->getById($model->getKey())->is($model));
    }


    public function testAll(): void
    {
        $repository = $this->getRepository();
        for ($x = 0; $x < 5; $x++) {
            $repository->import($this->getModelData());
        }


        self::assertCount(5, $repository->all());
    }


    public function testCreate(): void
    {
        $repository = $this->getRepository();
        $modelData = $this->getModelData();
        $data = $modelData + $this->getAdditionalCreateData();
        $model = $repository->create($data);
        $skip = $this->getSkipModelComparisonKeys();

        foreach ($modelData as $key => $value) {
            if (in_array($key, $skip)) {
                continue;
            }

            self::assertSame($value, $model->$key);
        }
    }


    public function testCreateMany(): void
    {
        $repository = $this->getRepository();
        $data = [
            $this->getModelData() + $this->getAdditionalCreateData(),
            $this->getModelData() + $this->getAdditionalCreateData(),
            $this->getModelData() + $this->getAdditionalCreateData(),
            $this->getModelData() + $this->getAdditionalCreateData(),
            $this->getModelData() + $this->getAdditionalCreateData(),
        ];

        $collection = $repository->createMany($data);
        self::assertCount(5, $collection);
    }


    public function testImport(): void
    {
        $repository = $this->getRepository();
        $modelData = $this->getModelData();
        $data = $modelData + $this->getAdditionalCreateData();
        $model = $repository->import($data);

        foreach ($modelData as $key => $value) {
            self::assertSame($value, $model->$key);
        }
    }


    public function testImportMany(): void
    {
        $repository = $this->getRepository();
        $data = [
            $this->getModelData() + $this->getAdditionalCreateData(),
            $this->getModelData() + $this->getAdditionalCreateData(),
            $this->getModelData() + $this->getAdditionalCreateData(),
            $this->getModelData() + $this->getAdditionalCreateData(),
            $this->getModelData() + $this->getAdditionalCreateData(),
        ];

        $collection = $repository->importMany($data);
        self::assertCount(5, $collection);
    }


    public function testCache(): void
    {
        $this->app['config']->set('repository.cache.actions', [
            '/(.*)\.getById/',
        ]);

        $repository = $this->getRepository();
        $model = $repository->import($this->getModelData());

        $first = $repository->getById($model->getKey());
        $model->update($this->getUpdateData());
        $second = $repository->getById($model->getKey());
        Cache::flush();
        $third = $repository->getById($model->getKey());

        self::assertSame(
            Arr::only($first->getAttributes(), array_keys($this->getUpdateData())),
            Arr::only($second->getAttributes(), array_keys($this->getUpdateData())),
        );

        self::assertNotSame(
            Arr::only($first->getAttributes(), array_keys($this->getUpdateData())),
            Arr::only($third->getAttributes(), array_keys($this->getUpdateData())),
        );
    }


    public function testClearCache(): void
    {
        $this->app['config']->set('repository.cache.actions', [
            '/(.*)\.getById/',
        ]);

        $repository = $this->getRepository();
        $model = $repository->import($this->getModelData());

        // Make import calls clear the getById
        $this->app['config']->set('repository.cache.clear', [
            '/(.*)\.import/' => [
                '$1.getById',
            ],
        ]);

        $first = $repository->getById($model->getKey());
        $model->update($this->getUpdateData());
        $second = $repository->getById($model->getKey());
        // Import so we clear the cache
        $repository->import($this->getModelData());
        $third = $repository->getById($model->getKey());

        self::assertSame(
            Arr::only($first->getAttributes(), array_keys($this->getUpdateData())),
            Arr::only($second->getAttributes(), array_keys($this->getUpdateData())),
        );

        self::assertNotSame(
            Arr::only($first->getAttributes(), array_keys($this->getUpdateData())),
            Arr::only($third->getAttributes(), array_keys($this->getUpdateData())),
        );
    }
}
