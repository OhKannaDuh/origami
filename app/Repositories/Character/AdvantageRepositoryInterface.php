<?php

namespace App\Repositories\Character;

use App\Models\Character\Advantage;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PhpParser\ErrorHandler\Collecting;

/**
 * @extends RepositoryInterface<Advantage>
 */
interface AdvantageRepositoryInterface extends RepositoryInterface
{


    public function getByKey(string $key, array $columns = ['*']): Model;


    public function keyExists(string $key): bool;


    public function distinctions(): Collection;


    public function passions(): Collection;
}
