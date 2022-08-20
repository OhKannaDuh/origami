<?php

namespace Database\Seeders\Helpers;

use App\Models\Core\Skill;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class StartingSkills extends BaseHelper
{


    public function withKey(string $key): self
    {
        $this->validate($key);

        $clone = clone $this;
        $clone->data[] = $key;

        return $clone;
    }


    private function validate(string $key): void
    {
        try {
            Skill::query()->where('key', $key)->firstOrFail(['id']);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Skill with key "' . $key . "' not found.");
        }
    }
}
