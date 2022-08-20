<?php

namespace App\Providers;

use App\StringHelper;
use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Support\ServiceProvider;

/**
 * @infection-ignore-all
 */
final class ActionServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $actions = $this->getActions();
        foreach ($actions as $interface => $class) {
            $this->app->bind($interface, $class);
        }
    }


    /**
     * @return array<string,string>
     */
    private function getActions(): array
    {
        return $this->getActionList();
    }


    /**
     * Get an array/map of interface to class actions.
     *
     * @return array<string,string>
     */
    private function getActionList(): array
    {
        $list = [];

        $namespace = config('actions.namespaces.action', 'App\\Actions');
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
