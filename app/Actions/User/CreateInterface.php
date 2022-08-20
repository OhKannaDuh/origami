<?php

namespace App\Actions\User;

use App\Actions\ActionInterface;
use App\Models\User;

interface CreateInterface extends ActionInterface
{


    public function execute(array $context = []): User;
}
