<?php

namespace App\Http\Requests\Campaign;

final class UpdateRequest extends OwnerRequest
{


    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3',
            ],
            'description' => [
                'required',
                'string',
            ],
        ];
    }
}
