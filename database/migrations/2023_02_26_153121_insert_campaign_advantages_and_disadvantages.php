<?php

use App\Models\Character\Advantage;
use App\Models\Character\Disadvantage;
use App\Models\Core\AdvantageCategory;
use App\Models\Core\DisadvantageCategory;
use App\Repositories\Character\AdvantageRepositoryInterface;
use App\Repositories\Character\DisadvantageRepositoryInterface;
use App\Repositories\Core\AdvantageCategoryRepositoryInterface;
use App\Repositories\Core\DisadvantageCategoryRepositoryInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\App;

return new class extends Migration
{
    private AdvantageRepositoryInterface $advantages;

    private DisadvantageRepositoryInterface $disadvantages;

    private AdvantageCategoryRepositoryInterface $advantageCategories;

    private DisadvantageCategoryRepositoryInterface $disadvantageCategories;


    public function __construct()
    {
        $this->advantages = App::make(AdvantageRepositoryInterface::class);
        $this->disadvantages = App::make(DisadvantageRepositoryInterface::class);
        $this->advantageCategories = App::make(AdvantageCategoryRepositoryInterface::class);
        $this->disadvantageCategories = App::make(DisadvantageCategoryRepositoryInterface::class);
    }


    public function up(): void
    {
        $advantages = json_decode(file_get_contents(base_path('advantages.json')), true);
        foreach ($advantages as $advantage) {
            $this->updateAdvantage($advantage['key'], $advantage['effects'], $advantage['advantage_category_keys']);
        }

        $disadvantages = json_decode(file_get_contents(base_path('disadvantages.json')), true);
        foreach ($disadvantages as $disadvantage) {
            $this->updateDisadvantage($disadvantage['key'], $disadvantage['effects'], $disadvantage['disadvantage_category_keys']);
        }
    }


    private function updateAdvantage(string $key, string $effects, array $types): void
    {
        $changed = false;
        $advantage = $this->getAdvantage($key);
        if (!$advantage->effects) {
            $changed = true;
            $advantage->effects = $effects;
        }

        foreach ($types as $type) {
            $category = $this->getAdvantageCategory($type);

            if ($advantage->advantageCategories->contains($category->id)) {
                continue;
            }

            $changed = true;
            $advantage->advantageCategories()->attach($category->id);
        }

        if ($changed) {
            $advantage->save();
        }
    }


    private function updateDisadvantage(string $key, string $effects, array $types): void
    {
        $changed = false;
        $disadvantage = $this->getDisadvantage($key);
        if (!$disadvantage->effects) {
            $changed = true;
            $disadvantage->effects = $effects;
        }

        foreach ($types as $type) {
            $category = $this->getDisadvantageCategory($type);

            if ($disadvantage->disadvantageCategories->contains($category->id)) {
                continue;
            }

            $changed = true;
            $disadvantage->disadvantageCategories()->attach($category->id);
        }

        if ($changed) {
            $disadvantage->save();
        }
    }


    private function getAdvantage(string $key): Advantage
    {
        $model = $this->advantages->getByKey($key);
        assert($model instanceof Advantage);

        return $model;
    }


    private function getDisadvantage(string $key): Disadvantage
    {
        $model = $this->disadvantages->getByKey($key);
        assert($model instanceof Disadvantage);

        return $model;
    }


    private function getAdvantageCategory(string $key): AdvantageCategory
    {
        $model = $this->advantageCategories->getByKey($key);
        assert($model instanceof AdvantageCategory);

        return $model;
    }


    private function getDisadvantageCategory(string $key): DisadvantageCategory
    {
        $model = $this->disadvantageCategories->getByKey($key);
        assert($model instanceof DisadvantageCategory);

        return $model;
    }
};
