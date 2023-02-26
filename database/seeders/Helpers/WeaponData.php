<?php

namespace Database\Seeders\Helpers;

use App\Models\Core\Skill;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class WeaponData extends BaseHelper
{


    public function __construct()
    {
        $this->data = [
            'skill_key' => '',
            'range' => [
                'min' => 0,
                'max' => 0,
            ],
            'damage' => 0,
            'deadliness' => 0,
            'grips' => [],
        ];
    }


    public function withSkill(string $key): self
    {
        try {
            Skill::query()->where('key', $key)->firstOrFail(['id']);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Skill with key "' . $key . "' not found.");
        }

        $clone = clone $this;
        $clone->data['skill_key'] = $key;

        return $clone;
    }


    public function withRange(int $min, int $max = -1): self
    {
        if ($max === -1) {
            $max = $min;
        }

        $clone = clone $this;
        $clone->data['range']['min'] = $min;
        $clone->data['range']['max'] = $max;

        return $clone;
    }


    public function withDamage(int $value): self
    {
        $clone = clone $this;
        $clone->data['damage'] = $value;

        return $clone;
    }


    public function withDeadliness(int $value): self
    {
        $clone = clone $this;
        $clone->data['deadliness'] = $value;

        return $clone;
    }


    public function withOneHandedGrip(string $effect): self
    {

        $clone = clone $this;
        $clone->data['grips'][1] = $effect;

        return $clone;
    }


    public function withTwoHandedGrip(string $effect): self
    {

        $clone = clone $this;
        $clone->data['grips'][2] = $effect;

        return $clone;
    }
}
