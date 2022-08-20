<?php

namespace App\Repositories\Character;

use App\Models\Character\School;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends RepositoryInterface<School>
 */
interface SchoolRepositoryInterface extends RepositoryInterface
{


    public function getByKey(string $key, array $columns = ['*']): Model;


    public function keyExists(string $key): bool;
}
