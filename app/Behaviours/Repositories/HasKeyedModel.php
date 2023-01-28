<?php

namespace App\Behaviours\Repositories;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PhpParser\Node\Expr\AssignOp\Mod;

trait HasKeyedModel
{


    public function getByKey(string $key, array $columns = ['*']): Model
    {
        try {
            $model =  $this->execute(__FUNCTION__, fn(): Model => $this->getModel()->query()->where('key', $key)->firstOrFail($columns), [
                'key' => $key,
            ]);
        } catch (ModelNotFoundException $e) {
            $class = get_class($this->getModel());
            throw new ModelNotFoundException("Model for key '{$key}' not found for model '{$class}'.");
        }

        assert($model instanceof Model);

        return $model;
    }


    public function keyExists(string $key): bool
    {
        $exists = $this->execute(__FUNCTION__, fn(): bool => $this->getModel()->query()->where('key', $key)->exists(), [
            'key' => $key,
        ]);

        assert(is_bool($exists));

        return $exists;
    }


    abstract protected function getModel(): Model;


    abstract protected function execute(string $action, Closure $callback, array $context = []): mixed;
}
