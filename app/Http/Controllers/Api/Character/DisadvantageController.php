<?php

namespace App\Http\Controllers\Api\Character;

use App\Http\Controllers\Controller;
use App\Models\Character\Disadvantage;
use App\Repositories\Character\DisadvantageRepositoryInterface;
use Illuminate\Http\JsonResponse;

final class DisadvantageController extends Controller
{


    protected function all(DisadvantageRepositoryInterface $disadvantages): JsonResponse
    {
        return new JsonResponse([
            'disadvantages' => $disadvantages->all(),
        ]);
    }
}
