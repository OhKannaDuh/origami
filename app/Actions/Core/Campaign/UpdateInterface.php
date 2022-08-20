<?php

namespace App\Actions\Core\Campaign;

use App\Actions\ActionInterface;
use App\Models\Core\Campaign;

interface UpdateInterface extends ActionInterface
{


    public function execute(array $context = []): Campaign;
}
