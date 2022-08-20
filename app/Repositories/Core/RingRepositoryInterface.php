<?php

namespace App\Repositories\Core;

use App\Models\Core\Ring;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends RepositoryInterface<Ring>
 */
interface RingRepositoryInterface extends RepositoryInterface
{


    public function getByKey(string $key, array $columns = ['*']): Model;


    public function keyExists(string $key): bool;
}
