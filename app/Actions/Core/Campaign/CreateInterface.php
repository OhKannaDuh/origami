<?php

namespace App\Actions\Core\Campaign;

use App\Actions\ActionInterface;
use App\Models\Core\Campaign;

interface CreateInterface extends ActionInterface
{


    public function execute(array $context = []): Campaign;
}
