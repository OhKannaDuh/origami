<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template T as Model of Model
 */
interface RepositoryInterface
{


    public function bypassCache(): self;


    /**
     * @param string|int $id
     *
     * @return Model
     */
    public function getById(string|int $id): Model;


    /**
     * @return Collection<int|string, Model>
     */
    public function all(array $columns = ['*']): Collection;


    /**
     * Create an entity for this repository.
     *
     * @param array<string,mixed> $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model;


    /**
     * @param array $data
     *
     * @return Collection<int|string, Model>
     */
    public function createMany(array $data): Collection;


    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function import(array $attributes): Model;


    /**
     * @param array $data
     *
     * @return Collection<int|string, Model>
     */
    public function importMany(array $data): Collection;
}
