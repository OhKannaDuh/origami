<?php

namespace App\Actions\Character\Character;

use App\Actions\ActionInterface;

interface SaveStatsInterface extends ActionInterface
{


    public function execute(array $context = []): int;
}
