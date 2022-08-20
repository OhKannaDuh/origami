<?php

namespace Database\Seeders\Helpers;

use Illuminate\Contracts\Support\Arrayable;

abstract class BaseHelper implements Arrayable
{
    protected array $data = [];


    public function toArray(): array
    {
        return $this->data;
    }
}
