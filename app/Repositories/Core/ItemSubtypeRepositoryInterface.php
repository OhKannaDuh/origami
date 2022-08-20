<?php

namespace App\Repositories\Core;

use App\Models\Core\ItemSubtype;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends RepositoryInterface<ItemSubtype>
 */
interface ItemSubtypeRepositoryInterface extends RepositoryInterface
{


    public function getByKey(string $key, array $columns = ['*']): Model;


    public function keyExists(string $key): bool;
}
