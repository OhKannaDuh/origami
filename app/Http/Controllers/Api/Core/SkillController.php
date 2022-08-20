<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use App\Models\Core\Skill;
use Illuminate\Http\JsonResponse;

final class SkillController extends Controller
{


    protected function all(): JsonResponse
    {
        return new JsonResponse([
            'skills' => Skill::with('skillGroup')->get(),
        ]);
    }
}
