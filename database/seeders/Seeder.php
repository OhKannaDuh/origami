<?php

namespace Database\Seeders;

use App\Repositories\RepositoryInterface;

abstract class Seeder extends \Illuminate\Database\Seeder
{


    protected function getData(string $model): array
    {
        $directory = env('DATA_PATH');
        $table = (new $model())->getTable();

        $path = $directory . '/' . $table . '.json';
        $contents = file_get_contents($path);

        return json_decode($contents, true);
    }


    protected function createFrom(string $model, RepositoryInterface $repository): void
    {
        $data = $this->getData($model);

        foreach ($data as $datum) {
            $repository->create($datum);
        }
    }
}
