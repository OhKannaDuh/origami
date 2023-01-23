<?php

namespace App\Repositories\Core;

use App\Models\Core\DisadvantageCategory;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends RepositoryInterface<DisadvantageCategory>
 */
interface DisadvantageCategoryRepositoryInterface extends RepositoryInterface
{


    public function getByKey(string $key, array $columns = ['*']): Model;


    public function keyExists(string $key): bool;
}
