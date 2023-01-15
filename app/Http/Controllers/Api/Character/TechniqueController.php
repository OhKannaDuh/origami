<?php

namespace App\Http\Controllers\Api\Character;

use App\Http\Controllers\Controller;
use App\Models\Character\Technique;
use Illuminate\Http\JsonResponse;

final class TechniqueController extends Controller
{


    protected function all(): JsonResponse
    {
        return new JsonResponse([
            'techniques' => Technique::all()->load('techniqueSubtype.techniqueType'),
        ]);
    }
}
