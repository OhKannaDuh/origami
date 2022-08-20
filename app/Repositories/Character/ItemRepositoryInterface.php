<?php

namespace App\Repositories\Character;

use App\Models\Character\Item;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends RepositoryInterface<Item>
 */
interface ItemRepositoryInterface extends RepositoryInterface
{


    public function getByKey(string $key, array $columns = ['*']): Model;


    public function keyExists(string $key): bool;
}
