<?php

namespace App\Repositories\Core;

use App\Models\Core\AdvantageCategory;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends RepositoryInterface<AdvantageCategory>
 */
interface AdvantageCategoryRepositoryInterface extends RepositoryInterface
{


    public function getByKey(string $key, array $columns = ['*']): Model;


    public function keyExists(string $key): bool;
}
