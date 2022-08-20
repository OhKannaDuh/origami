<?php

namespace App\Repositories\Character;

use App\Models\Character\Clan;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends RepositoryInterface<Clan>
 */
interface ClanRepositoryInterface extends RepositoryInterface
{


    public function getByKey(string $key, array $columns = ['*']): Model;


    public function keyExists(string $key): bool;
}
