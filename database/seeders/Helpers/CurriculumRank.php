<?php

namespace Database\Seeders\Helpers;

use App\Models\Character\Technique;
use App\Models\Core\Skill;
use App\Models\Core\SkillGroup;
use App\Models\Core\TechniqueSubtype;
use App\Models\Core\TechniqueType;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class CurriculumRank extends BaseHelper
{


    public function withSkillGroup(string $key): self
    {
        try {
            SkillGroup::query()->where('key', $key)->firstOrFail(['id']);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Skill Group with key "' . $key . "' not found.");
        }

        $clone = clone $this;
        $clone->data[] = [
            'type' => 'skill-group',
            'skill_group_key' => $key,
        ];

        return $clone;
    }


    public function withSkill(string $key): self
    {
        try {
            Skill::query()->where('key', $key)->firstOrFail(['id']);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Skill with key "' . $key . "' not found.");
        }

        $clone = clone $this;
        $clone->data[] = [
            'type' => 'skill',
            'skill_key' => $key,
        ];

        return $clone;
    }


    public function withTechniqueSubtype(string $key, int $minRank = 1, int $maxRank = 0, bool $ignoreRequirements = false): self
    {
        try {
            TechniqueSubtype::query()->where('key', $key)->firstOrFail(['id']);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Technique Subtype with key "' . $key . "' not found.");
        }

        if ($maxRank === 0) {
            $maxRank = $minRank;
        }

        $clone = clone $this;
        $clone->data[] = [
            'type' => 'technique-subtype',
            'technique_subtype_key' => $key,
            'min_rank' => $minRank,
            'max_rank' => $maxRank,
            'ignore_requirements' => $ignoreRequirements,
        ];

        return $clone;
    }


    public function withTechniqueType(string $key, int $minRank = 1, int $maxRank = 0, bool $ignoreRequirements = false): self
    {
        try {
            TechniqueType::query()->where('key', $key)->firstOrFail(['id']);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Technique Type with key "' . $key . "' not found.");
        }

        if ($maxRank === 0) {
            $maxRank = $minRank;
        }

        $clone = clone $this;
        $clone->data[] = [
            'type' => 'technique-type',
            'technique_type_key' => $key,
            'min_rank' => $minRank,
            'max_rank' => $maxRank,
            'ignore_requirements' => $ignoreRequirements,
        ];

        return $clone;
    }


    public function withTechnique(string $key, bool $ignoreRequirements = false): self
    {
        try {
            Technique::query()->where('key', $key)->firstOrFail(['id']);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Technique with key "' . $key . "' not found.");
        }


        $clone = clone $this;
        $clone->data[] = [
            'type' => 'technique',
            'technique_key' => $key,
            'ignore_requirements' => $ignoreRequirements,
        ];

        return $clone;
    }
}
