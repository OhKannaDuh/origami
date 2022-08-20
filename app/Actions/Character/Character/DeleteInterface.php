<?php

namespace App\Actions\Character\Character;

use App\Actions\ActionInterface;

interface DeleteInterface extends ActionInterface
{


    public function execute(array $context = []): bool|null;
}
