<?php

namespace App\Repositories\Core;

use App\Models\Core\TechniqueType;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends RepositoryInterface<TechniqueType>
 */
interface TechniqueTypeRepositoryInterface extends RepositoryInterface
{


    public function getByKey(string $key, array $columns = ['*']): Model;


    public function keyExists(string $key): bool;
}
