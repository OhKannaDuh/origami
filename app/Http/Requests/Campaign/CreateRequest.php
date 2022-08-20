<?php

namespace App\Http\Requests\Campaign;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\Request;
use App\Validation\Rules;
use Illuminate\Support\Arr;

final class CreateRequest extends AuthRequest
{


    public function rules(): array
    {
        return [
            'name' => (new Rules())
                ->required()
                ->string(),
        ];
    }


    public function name(): string
    {
        $name = Arr::get($this->all(), 'name');
        assert(is_string($name));

        return $name;
    }
}
