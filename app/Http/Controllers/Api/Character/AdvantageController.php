<?php

namespace App\Http\Controllers\Api\Character;

use App\Http\Controllers\Controller;
use App\Repositories\Character\AdvantageRepositoryInterface;
use Illuminate\Http\JsonResponse;

final class AdvantageController extends Controller
{


    protected function all(AdvantageRepositoryInterface $advantages): JsonResponse
    {
        return new JsonResponse([
            'advantages' => $advantages->all(),
        ]);
    }
}
