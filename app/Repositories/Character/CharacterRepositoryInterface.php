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


    /**
     * @param Character $character
     * @param array $stats
     *
     * @return bool
     */
    public function updateStats(Character $character, array $stats): bool;
}
