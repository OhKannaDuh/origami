<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class AuthRequest extends Request
{


    public function authorize(): bool
    {
        return Auth::check();
    }
}
