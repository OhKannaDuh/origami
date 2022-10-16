<?php

namespace Database\Seeders\Helpers;

final class PatternData extends BaseHelper
{


    public function __construct()
    {
        $this->data = [
            'damage' => 0,
            'deadliness' => 0,
            'cost' => 0,
            'physical_resistance' => 0,
            'supernatural_resistance' => 0,
            'weapon' => false,
            'armor' => false,
        ];
    }


    public function withDamage(int $damage): self
    {
        $clone = clone $this;
        $clone->data['damage'] = $damage;
        return $clone;
    }


    public function withDeadliness(int $deadliness): self
    {
        $clone = clone $this;
        $clone->data['deadliness'] = $deadliness;
        return $clone;
    }


    public function withCost(int $cost): self
    {
        $clone = clone $this;
        $clone->data['cost'] = $cost;
        return $clone;
    }


    public function withPhysicalResistance(int $resistance): self
    {
        $clone = clone $this;
        $clone->data['physical_resistance'] = $resistance;
        return $clone;
    }


    public function withSupernaturalResistance(int $resistance): self
    {
        $clone = clone $this;
        $clone->data['supernatural_resistance'] = $resistance;
        return $clone;
    }


    public function withForWeapon(): self
    {
        $clone = clone $this;
        $clone->data['weapon'] = true;
        return $clone;
    }


    public function withForArmor(): self
    {
        $clone = clone $this;
        $clone->data['armor'] = true;
        return $clone;
    }
}
