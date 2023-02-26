<?php

namespace Database\Seeders\Helpers;

use App\Models\Character\Technique;
use App\StringHelper;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class StartingTechniques extends BaseHelper
{


    public function withGroup(string $group, array $techniques): self
    {
        foreach ($techniques as $techniqueKey) {
            $this->validate($techniqueKey);
        }

        $key = StringHelper::key($group);

        $clone = clone $this;
        $clone->data[$this->getNextKey($key, 'group')] = [
            'key' => $key,
            'name' => $group,
            'type' => 'group',
            'techniques' => $techniques,
        ];

        return $clone;
    }


    public function withChoice(string $group, int $amount, array $techniques): self
    {
        foreach ($techniques as $techniqueKey) {
            $this->validate($techniqueKey);
        }

        $key = StringHelper::key($group);

        $clone = clone $this;
        $clone->data[$this->getNextKey($key, 'choice')] = [
            'key' => $key,
            'name' => $group,
            'type' => 'choice',
            'amount' => $amount,
            'techniques' => $techniques,
        ];

        return $clone;
    }


    private function validate(string $key): void
    {
        try {
            Technique::query()->where('key', $key)->firstOrFail(['id']);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Technique with key "' . $key . "' not found.");
        }
    }


    private function hasKey(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }


    private function getNextKey(string $key, string $suffix): string
    {
        $iteration = 0;
        do {
            $iteration++;
            $subject = "{$key}-{$suffix}-{$iteration}";
        } while ($this->hasKey($subject));

        return $subject;
    }
}
