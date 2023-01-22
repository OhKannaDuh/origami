<?php

namespace Database\Seeders;

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
}
