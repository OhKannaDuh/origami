<?php

namespace App\Actions\Character\Character;

use App\Actions\ActionInterface;

interface SaveDisadvantagesInterface extends ActionInterface
{


    public function execute(array $context = []): int;
}
