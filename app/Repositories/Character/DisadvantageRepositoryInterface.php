<?php

namespace App\Repositories\Character;

use App\Models\Character\Disadvantage;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends RepositoryInterface<Disadvantage>
 */
interface DisadvantageRepositoryInterface extends RepositoryInterface
{


    public function getByKey(string $key, array $columns = ['*']): Model;


    public function keyExists(string $key): bool;


    public function adversities(): Collection;


    public function anxieties(): Collection;
}
