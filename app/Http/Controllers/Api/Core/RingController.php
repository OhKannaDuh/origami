<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use App\Models\Core\Ring;
use Illuminate\Http\JsonResponse;

use function Pest\Laravel\get;

final class RingController extends Controller
{


    protected function all(): JsonResponse
    {
        return new JsonResponse([
            'rings' => Ring::all(),
        ]);
    }


    protected function version(): JsonResponse
    {
        $latest = Ring::query()->latest()->first();
        assert($latest instanceof Ring);

        return new JsonResponse([
            'version' => $latest->updated_at->timestamp,
        ]);
    }
}
