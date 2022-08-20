<?php

namespace App\Actions;

interface ActionInterface
{


    public function execute(array $context = []): mixed;
}
