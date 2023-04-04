<?php

namespace App\Console\Commands\Export;

use App\Repositories\RepositoryInterface;
use App\StringHelper;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

abstract class Export
{
    protected RepositoryInterface $repository;


    /**
     * @return class-string<RepositoryInterface>
     */
    abstract protected function getRepositoryClass(): string;


    public function __construct()
    {
        $this->repository = App::make($this->getRepositoryClass());
        assert($this->repository instanceof RepositoryInterface);
    }


    protected function getColumnsToRemove(): array
    {
        return [
            'created_at',
            'updated_at'
        ];
    }


    public function getData(): array
    {
        $data = $this->repository->all();
        $data->load($this->getRelationships());
        $data = $data->map(function (Arrayable $item) {
            return Arr::except($item, $this->getColumnsToRemove());
        });

        return $data->toArray();
    }


    public function getTable(): string
    {
        $repositoryClass = $this->getRepositoryClass();

        $repository = App::make($repositoryClass);
        assert($repository instanceof RepositoryInterface);

        return $repository->getModel()->getTable();
    }


    protected function getRelationships(): array
    {
        return [];
    }
}
