<?php

namespace App\Actions\Character\Character;

use App\Actions\ActionInterface;

interface SaveAdvancementsInterface extends ActionInterface
{


    public function execute(array $context = []): int;
}
