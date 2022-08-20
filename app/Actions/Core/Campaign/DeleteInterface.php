<?php

namespace App\Actions\Core\Campaign;

use App\Actions\ActionInterface;

interface DeleteInterface extends ActionInterface
{


    public function execute(array $context = []): bool|null;
}
