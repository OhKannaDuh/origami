<?php

use App\Http\Controllers\Api\Character\AdvantageController;
use App\Http\Controllers\Api\Character\DataController;
use App\Http\Controllers\Api\Character\DisadvantageController;
use App\Http\Controllers\Api\Character\ItemController;
use App\Http\Controllers\Api\Character\SaveController;
use App\Http\Controllers\Api\Character\TechniqueController;
use App\Http\Controllers\Api\Core\RingController;
use App\Http\Controllers\Api\Core\SkillController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

assert($router instanceof Router);

$router->middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
})->name('api.user');

$router->get('/advantages/all', [AdvantageController::class, 'all'])->name('api.advantages.all');
$router->get('/disadvantages/all', [DisadvantageController::class, 'all'])->name('api.disadvantages.all');
$router->get('/items/all', [ItemController::class, 'all'])->name('api.items.all');
$router->get('/rings/all', [RingController::class, 'all'])->name('api.rings.all');
$router->get('/skills/all', [SkillController::class, 'all'])->name('api.skills.all');
$router->get('/techniques/all', [TechniqueController::class, 'all'])->name('api.techniques.all');


$router->prefix('/character')->group(function (Router $router) {
    $router->get('/data/all', [DataController::class, 'all'])->name('api.character.data.all');
});

$router->prefix('/character/save')->group(function (Router $router) {
    $router->put('/advancements', [SaveController::class, 'advancements'])->name('api.character.save.advancements');
    $router->put('/advantages', [SaveController::class, 'advantages'])->name('api.character.save.advantages');
    $router->put('/disadvantages', [SaveController::class, 'disadvantages'])->name('api.character.save.disadvantages');
    $router->put('/inventory', [SaveController::class, 'inventory'])->name('api.character.save.inventory');
    $router->put('/stats', [SaveController::class, 'stats'])->name('api.character.save.stats');
});
