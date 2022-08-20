<?php

namespace App\Http\Controllers\Api\Character;

use App\Http\Controllers\Controller;
use App\Repositories\Character\AdvantageRepositoryInterface;
use App\Repositories\Character\ClanRepositoryInterface;
use App\Repositories\Character\DisadvantageRepositoryInterface;
use App\Repositories\Character\FamilyRepositoryInterface;
use App\Repositories\Character\ItemRepositoryInterface;
use App\Repositories\Character\SchoolRepositoryInterface;
use App\Repositories\Character\TechniqueRepositoryInterface;
use App\Repositories\Core\ItemSubtypeRepositoryInterface;
use App\Repositories\Core\ItemTypeRepositoryInterface;
use App\Repositories\Core\RingRepositoryInterface;
use App\Repositories\Core\SkillRepositoryInterface;
use App\Repositories\Core\TechniqueTypeRepositoryInterface;
use Illuminate\Http\JsonResponse;

final class DataController extends Controller
{


    public function __construct(
        private AdvantageRepositoryInterface $advantages,
        private ClanRepositoryInterface $clans,
        private DisadvantageRepositoryInterface $disadvantages,
        private FamilyRepositoryInterface $families,
        private ItemRepositoryInterface $items,
        private ItemSubtypeRepositoryInterface $itemSubtypes,
        private ItemTypeRepositoryInterface $itemTypes,
        private RingRepositoryInterface $rings,
        private SchoolRepositoryInterface $schools,
        private SkillRepositoryInterface $skills,
        private TechniqueRepositoryInterface $techniques,
        private TechniqueTypeRepositoryInterface $techniqueTypes,
    ) {
    }


    protected function all(): JsonResponse
    {
        return new JsonResponse([
            'adversities' => $this->disadvantages->adversities()->load([
                'ring',
            ]),
            'anxieties' => $this->disadvantages->anxieties()->load([
                'ring',
            ]),
            'clans' => $this->clans->all()->load([
                'ring',
                'skill',
            ]),
            'distinctions' => $this->advantages->distinctions()->load([
                'ring',
            ]),
            'families' => $this->families->all()->load([
                'clan',
                'ringChoiceOne',
                'ringChoiceTwo',
                'skillOne',
                'skillTwo',
            ]),
            'item_subtypes' => $this->itemSubtypes->all(),
            'item_types' => $this->itemTypes->all(),
            'items' => $this->items->all()->load([
                'itemSubtype.itemType',
            ]),
            'passions' => $this->advantages->passions()->load([
                'ring',
            ]),
            'rings' => $this->rings->all(),
            'schools' => $this->schools->all()->load([
                'availableTechniqueSubtypes',
                'availableTechniqueTypes',
                'family.clan',
                'ringOne',
                'ringTwo',
                'schoolTypes',
            ]),
            'skills' => $this->skills->all(),
            'technique_types' => $this->techniqueTypes->all(),
            'techniques' => $this->techniques->all(),
        ]);
    }
}
