<?php

namespace App\Repositories\Core;

use App\Models\Core\DisadvantageType;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends RepositoryInterface<DisadvantageType>
 */
interface DisadvantageTypeRepositoryInterface extends RepositoryInterface
{


    public function getByKey(string $key, array $columns = ['*']): Model;


    public function keyExists(string $key): bool;
}
