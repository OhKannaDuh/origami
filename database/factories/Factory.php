<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory as FactoryHelper;
use Illuminate\Database\Eloquent\Model;

abstract class Factory extends \Illuminate\Database\Eloquent\Factories\Factory
{


    /**
     * @param class-string<Model>&string $class
     */
    protected function firstOrCreate(string $class): Model
    {
        /** @var Model */
        $model = new $class();

        if ($model->all()->count() <= 0) {
            $factory = FactoryHelper::factoryForModel(get_class($model));
            $factory->create();
        }

        return $class::first();
    }
}
