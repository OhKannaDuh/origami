<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;
use App\Validation\Rules;

final class LoginRequest extends Request
{


    public function rules(): array
    {
        return [
            'email' => (new Rules())
                ->required()
                ->string(),
            'password' => (new Rules())
                ->required()
                ->string(),
        ];
    }
}
