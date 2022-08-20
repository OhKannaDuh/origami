<?php

namespace App\Actions\Character\Character;

use App\Actions\ActionInterface;

interface SaveInventoryInterface extends ActionInterface
{


    public function execute(array $context = []): bool;
}
