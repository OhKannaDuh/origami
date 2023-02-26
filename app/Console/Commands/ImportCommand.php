<?php

namespace App\Console\Commands;

use App\Models\Character\Advantage;
use App\Models\Character\Disadvantage;
use App\Models\Core\AdvantageCategory;
use App\Models\Core\DisadvantageCategory;
use App\Repositories\Character\AdvantageRepositoryInterface;
use App\Repositories\Character\DisadvantageRepositoryInterface;
use App\Repositories\Core\AdvantageCategoryRepositoryInterface;
use App\Repositories\Core\DisadvantageCategoryRepositoryInterface;
use Illuminate\Console\Command;

class ImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(
        AdvantageRepositoryInterface $advantages,
        AdvantageCategoryRepositoryInterface $advantageCategories,
        DisadvantageRepositoryInterface $disadvantages,
        DisadvantageCategoryRepositoryInterface $disadvantageCategories,
    ) {
        $updated = $this->importAdvantages($advantages, $advantageCategories);
        $this->comment('Updated ' . $updated . ' Advantages.');

        $updated = $this->importDisadvantages($disadvantages, $disadvantageCategories);
        $this->comment('Updated ' . $updated . ' Disadvantages.');

        return 0;
    }


    private function importAdvantages(
        AdvantageRepositoryInterface $repository,
        AdvantageCategoryRepositoryInterface $categories,
    ): int {
        $path = base_path('data/imports/advantages.json');
        $contents = file_get_contents($path);
        $data = json_decode($contents, true);

        $updated = 0;
        foreach ($data as $datum) {
            $changed = false;
            $model = $repository->bypassCache()->getByKey($datum['key']);
            assert($model instanceof Advantage);

            if (!$model->effects && $datum['effects']) {
                $model->effects = $datum['effects'];
                $changed = true;
            }

            foreach ($datum['advantage_category_keys'] as $key) {
                $category = $categories->getByKey($key);
                assert($category instanceof AdvantageCategory);

                if ($model->advantageCategories->contains($category->id)) {
                    continue;
                }

                $changed = true;
                $model->advantageCategories()->attach($category->id);
            }

            if ($changed) {
                $updated++;
                $model->save();
            }
        }

        return $updated;
    }


    private function importDisadvantages(
        DisadvantageRepositoryInterface $repository,
        DisadvantageCategoryRepositoryInterface $categories,
    ): int {
        $path = base_path('data/imports/disadvantages.json');
        $contents = file_get_contents($path);
        $data = json_decode($contents, true);

        $updated = 0;
        foreach ($data as $datum) {
            $changed = false;
            $model = $repository->bypassCache()->getByKey($datum['key']);
            assert($model instanceof Disadvantage);

            if (!$model->effects && $datum['effects']) {
                $model->effects = $datum['effects'];
                $changed = true;
            }

            foreach ($datum['disadvantage_category_keys'] as $key) {
                $category = $categories->getByKey($key);
                assert($category instanceof DisadvantageCategory);

                if ($model->disadvantageCategories->contains($category->id)) {
                    continue;
                }

                $changed = true;
                $model->disadvantageCategories()->attach($category->id);
            }

            if ($changed) {
                $updated++;
                $model->save();
            }
        }

        return $updated;
    }
}
