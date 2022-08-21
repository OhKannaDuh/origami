<?php

namespace App\Repositories;

use App\StringHelper;
use Closure;
use Illuminate\Cache\TaggedCache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Validator;
use PhpParser\Node\Expr\AssignOp\Mod;

/**
 * @template T as Model of Model
 * @implements RepositoryInterface<T>
 */
abstract class BaseRepository implements RepositoryInterface
{
    protected Model $model;

    private Validator|null $createValidator = null;


    abstract protected function getCreateRules(array $context): array;


    protected function processCreateData(array $context): array
    {
        $fillable = $this->getModel()->getFillable();
        return Arr::only($context, $fillable);
    }


    protected function getModel(): Model
    {
        return $this->model;
    }


    protected function getKeyPrefix(): string
    {
        return $this->getModel()->getTable();
    }


    protected function getCache(string $tag): TaggedCache
    {
        return Cache::tags($tag);
    }


    protected function getCacheTtl(): int
    {
        $ttl  = config('repositories.cache.ttl', 3600);
        assert(is_int($ttl));

        return $ttl;
    }


    protected function getCachesToClear(string $key): array
    {
        $config = config('repository.cache.clear', []);
        assert(is_array($config));

        foreach ($config as $pattern => $keys) {
            $matches = [];
            if (preg_match($pattern, $key, $matches) !== 1) {
                continue;
            }

            $processed = [];
            foreach ($keys as $cacheKey) {
                foreach ($matches as $index => $match) {
                    $search = '$' . $index;
                    $cacheKey = StringHelper::replace($search, $match, $cacheKey);
                }

                $processed[] = $cacheKey;
            }

            return $processed;
        }

        return [];
    }


    protected function shouldCache(string $key): bool
    {
        $config = config('repository.cache.actions', []);
        assert(is_array($config));

        foreach ($config as $pattern) {
            if (preg_match($pattern, $key) === 1) {
                return true;
            }
        }

        return false;
    }


    protected function execute(string $action, Closure $callback, array $context = []): mixed
    {
        $key = $this->getKeyPrefix() . '.' . $action;
        $tag = $key;

        foreach ($context as $contextKey => $value) {
            $key .= '.' . $contextKey . '.' . $value;
        }

        $caches = $this->getCachesToClear($key);
        foreach ($caches as $cache) {
            $this->getCache($cache)->flush();
        }

        if ($this->shouldCache($key)) {
            $ttl = $this->getCacheTtl();
            return $this->getCache($tag)->remember($key, $ttl, $callback);
        }

        return $callback();
    }


    public function getCreateValidator(): Validator
    {
        if ($this->createValidator === null) {
            /** @var Validator $validator */
            $validator = validator()->make([], []);

            $this->createValidator = $validator;
        }

        return $this->createValidator;
    }


    public function getById(string|int $id): Model
    {
        $model = $this->execute(__FUNCTION__, fn(): Model|null => $this->getModel()->query()->find($id), [
            'id' => $id,
        ]);
        assert($model instanceof Model);

        return $model;
    }


    public function all(array $columns = ['*']): Collection
    {
        $collection = $this->execute(__FUNCTION__, fn(): Collection => $this->getModel()->all($columns));
        assert($collection instanceof Collection);

        return $collection;
    }


    public function create(array $attributes): Model
    {
        $this->getCreateValidator()
            ->setData($attributes)
            ->setRules($this->getCreateRules($attributes))
            ->validate();

        $data = $this->processCreateData($attributes);

        $model = $this->execute(__FUNCTION__, fn (): Model => $this->getModel()->query()->create($data));
        assert($model instanceof Model);

        return $model;
    }


    public function createMany(array $data): Collection
    {
        /** @var Collection<int|string, T> */
        $collection = new Collection();
        foreach ($data as $datum) {
            $collection->add($this->create($datum));
        }

        return $collection;
    }


    public function import(array $attributes): Model
    {
        $table = $this->getModel()->getTable();
        $columns = Schema::getColumnListing($table);
        $data = Arr::only($attributes, $columns);

        $model = $this->execute(__FUNCTION__, fn (): Model => $this->getModel()->query()->create($data));
        assert($model instanceof Model);

        return $model;
    }


    public function importMany(array $data): Collection
    {
        /** @var Collection<int|string, T> */
        $collection = new Collection();
        foreach ($data as $datum) {
            $collection->add($this->import($datum));
        }

        return $collection;
    }
}
