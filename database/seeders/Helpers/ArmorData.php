<?php

namespace Database\Seeders\Helpers;

use App\Models\Core\Skill;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class ArmorData extends BaseHelper
{


    public function __construct()
    {
        $this->data = [
            'physical' => 0,
            'supernatural' => 0,
        ];
    }


    public function withPhysical(int $value): self
    {
        $clone = clone $this;
        $clone->data['physical'] = $value;

        return $clone;
    }


    public function withSupernatural(int $value): self
    {
        $clone = clone $this;
        $clone->data['supernatural'] = $value;

        return $clone;
    }
}
