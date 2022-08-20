<?php

namespace App\Http\Controllers\Api\Character;

use App\Http\Controllers\Controller;
use App\Models\Character\Item;
use App\Repositories\Character\ItemRepositoryInterface;
use Illuminate\Http\JsonResponse;

use function GuzzleHttp\Promise\all;

final class ItemController extends Controller
{


    protected function all(ItemRepositoryInterface $items): JsonResponse
    {
        return new JsonResponse([
            'items' => $items->all(),
        ]);
    }
}
