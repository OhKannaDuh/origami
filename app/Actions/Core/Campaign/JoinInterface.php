<?php

namespace App\Actions\Core\Campaign;

use App\Actions\ActionInterface;
use App\Enums\Core\Campaign\JoinResponse;

interface JoinInterface extends ActionInterface
{


    public function execute(array $context = []): JoinResponse;
}
