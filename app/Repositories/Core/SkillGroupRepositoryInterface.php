<?php

namespace App\Repositories\Core;

use App\Models\Core\SkillGroup;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends RepositoryInterface<SkillGroup>
 */
interface SkillGroupRepositoryInterface extends RepositoryInterface
{


    public function getByKey(string $key, array $columns = ['*']): Model;


    public function keyExists(string $key): bool;
}
