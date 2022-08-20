<?php

namespace App\Actions\Character\Character;

use App\Actions\ActionInterface;
use App\Models\Character\Character;

interface CopyInterface extends ActionInterface
{


    public function execute(array $context = []): Character;
}
