<?php

namespace App\Repositories\Core;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Core\SourceBook;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<SourceBook>
 */
final class SourceBookRepository extends BaseRepository implements SourceBookRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param SourceBook $model
     */
    public function __construct(SourceBook $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }
}
