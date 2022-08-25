<?php

namespace App\Behaviours;

use App\Repositories\RepositoryInterface;
use App\StringHelper;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\App;

trait HasRepository
{


    /**
     * @return RepositoryInterface
     *
     * @throws BindingResolutionException
     */
    protected static function repository(): RepositoryInterface
    {
        $repository = self::newRepository();
        if ($repository instanceof RepositoryInterface) {
            return $repository;
        }

        $class = static::class;
        $prefix = config('repository.namespaces.model');
        assert(is_string($prefix));

        if (StringHelper::startsWith($class, $prefix)) {

            $class = StringHelper::after($class, $prefix);
        }

        $class = config('repository.namespaces.repository') . $class . 'Repository';

        /** @var RepositoryInterface $repository */
        $repository = App::make($class);
        assert($repository instanceof RepositoryInterface);

        return $repository;
    }


    private static function newRepository(): mixed
    {
        return null;
    }
}
