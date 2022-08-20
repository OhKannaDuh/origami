<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use App\Models\Core\Ring;
use Illuminate\Http\JsonResponse;

final class RingController extends Controller
{


    protected function all(): JsonResponse
    {
        return new JsonResponse([
            'rings' => Ring::all(),
        ]);
    }
}
