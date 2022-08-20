<?php

namespace App\Repositories\Core;

use App\Models\Core\TechniqueSubtype;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends RepositoryInterface<TechniqueSubtype>
 */
interface TechniqueSubtypeRepositoryInterface extends RepositoryInterface
{


    public function getByKey(string $key, array $columns = ['*']): Model;


    public function keyExists(string $key): bool;
}
