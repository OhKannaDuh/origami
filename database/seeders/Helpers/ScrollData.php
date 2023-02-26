<?php

namespace Database\Seeders\Helpers;

final class ScrollData extends BaseHelper
{


    public function __construct()
    {
        $this->data = [
            'prerequisites' => '',
            'cost' => 0,
            'effect' => '',
        ];
    }


    public function withPrerequisites(string $prerequisites): self
    {
        $clone = clone $this;
        $clone->data['prerequisites'] = $prerequisites;
        return $clone;
    }


    public function withCost(int $cost): self
    {
        $clone = clone $this;
        $clone->data['cost'] = $cost;
        return $clone;
    }


    public function withEffect(string $effect): self
    {
        $clone = clone $this;
        $clone->data['effect'] = $effect;
        return $clone;
    }
}
