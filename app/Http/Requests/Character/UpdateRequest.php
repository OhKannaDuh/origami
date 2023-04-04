<?php

namespace App\Http\Requests\Character;

use Illuminate\Support\Arr;

final class UpdateRequest extends CharacterRequest
{


    public function rules(): array
    {
        return [
            'name' => [
                'string',
            ],
            'allowNonhumanTechniques' => [
                'boolean',
            ],
        ];
    }


    public function name(): string
    {
        $name = Arr::get($this->all(), 'name');
        assert(is_string($name));

        return $name;
    }


    public function allowNonhumanTechniques(): bool
    {
        $allowNonhumanTechniques = Arr::get($this->all(), 'allowNonhumanTechniques');
        assert(is_bool($allowNonhumanTechniques));

        return $allowNonhumanTechniques;
    }
}
