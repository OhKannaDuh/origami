<?php

namespace App\Validation;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

final class Rules implements Arrayable
{
    /** @var string[] */
    private array $rules = [];


    /**
     * @param class-string<Model>&string $class
     */
    private function getModel(string $class): Model
    {
        return new $class();
    }


    /**
     * @param class-string<Model>&string $class
     */
    public function exists(string $class, string $column = null): self
    {
        $model = $this->getModel($class);

        if ($column === null) {
            $column = $model->getKeyName();
        }

        $clone = clone $this;
        $clone->rules[] = 'exists:' . $model->getTable() . ',' . $column;
        return $clone;
    }


    public function required(): self
    {
        $clone = clone $this;
        $clone->rules[] = 'required';
        return $clone;
    }


    public function requiredIf(string $if): self
    {
        $clone = clone $this;
        $clone->rules[] = 'required_if:' . $if;
        return $clone;
    }


    public function present(): self
    {
        $clone = clone $this;
        $clone->rules[] = 'present';
        return $clone;
    }


    public function string(): self
    {
        $clone = clone $this;
        $clone->rules[] = 'string';
        return $clone;
    }


    public function uuid(): self
    {
        $clone = clone $this;
        $clone->rules[] = 'uuid';
        return $clone;
    }


    public function integer(): self
    {
        $clone = clone $this;
        $clone->rules[] = 'integer';
        return $clone;
    }


    public function array(int $size = 0): self
    {
        $clone = clone $this;
        $clone->rules[] = 'array' . ($size <= 0 ? '' : '|size:' . $size);
        return $clone;
    }


    public function in(array $options): self
    {
        $clone = clone $this;
        $clone->rules[] = Rule::in($options);
        return $clone;
    }


    public function has(string $option): bool
    {
        return in_array($option, $this->rules);
    }


    public function toArray(): array
    {
        return $this->rules;
    }
}
