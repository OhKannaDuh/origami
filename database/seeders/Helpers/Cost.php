<?php

namespace Database\Seeders\Helpers;

final class Cost extends BaseHelper
{


    public function __construct()
    {
        $this->data = [
            'zeni' => 0,
            'bu' => 0,
            'koku' => 0,
        ];
    }


    public function withZeni(int $amount): self
    {
        $clone = clone $this;
        $clone->data['zeni'] = $amount;

        return $clone;
    }


    public function withBu(int $amount): self
    {
        $clone = clone $this;
        $clone->data['bu'] = $amount;

        return $clone;
    }


    public function withKoku(int $amount): self
    {
        $clone = clone $this;
        $clone->data['koku'] = $amount;

        return $clone;
    }
}
