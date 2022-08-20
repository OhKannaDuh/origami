<?php

namespace App\Repositories\Character;

use App\Models\Character\Character;
use App\Repositories\RepositoryInterface;

/**
 * @extends RepositoryInterface<Character>
 */
interface CharacterRepositoryInterface extends RepositoryInterface
{


    /**
     * @param string $uuid
     *
     * @return Character
     */
    public function getByUuid(string $uuid): Character;
}
