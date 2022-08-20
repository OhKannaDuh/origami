<?php

namespace App\Providers;

use App\StringHelper;
use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $repositories = $this->getRepositories();
        foreach ($repositories as $interface => $class) {
            $this->app->bind($interface, $class);
        }
    }


    /**
     * Get the repositories from the cache if enabled.
     *
     * @return array<string,string>
     */
    private function getRepositories(): array
    {
        return $this->getRepositoryList();
    }


    /**
     * Get an array/map of interface to class repositories.
     *
     * @return array<string,string>
     */
    private function getRepositoryList(): array
    {
        $list = [];

        $namespace = config('repositories.namespaces.repository', 'App\\Repositories');
        assert(is_string($namespace));

        $repositories = collect(ClassFinder::getClassesInNamespace($namespace, ClassFinder::RECURSIVE_MODE));
        $repositories = $repositories->filter(fn ($value) => !StringHelper::endsWith($value, 'Interface'));
        foreach ($repositories as $class) {
            $interface = $class . 'Interface';
            if (!interface_exists($interface)) {
                continue;
            }

            $list[$interface] = $class;
        }

        return $list;
    }
}
