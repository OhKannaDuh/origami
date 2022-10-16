<?php

namespace App\Console\Commands\Helpers;

use App\StringHelper;

final class CurriculumParser
{


    public function parse(array $lines): array
    {
        $curriculum = [];
        $start = false;

        foreach ($lines as $line) {
            $line = StringHelper::transliterate($line);

            if (preg_match('/RANK 1/', $line) === 1) {
                $start = true;
            }

            if (preg_match('/RANK 6/', $line) === 1) {
                return [
                    'curriculum' => $this->getData(implode(PHP_EOL, $curriculum)),
                ];
            }

            if ($start) {
                $curriculum[] = $line;
            }
        }

        return [];
    }


    private function getData(string $input): array
    {
        $data = [];
        $rank = 0;

        foreach (explode(PHP_EOL, $input) as $line) {
            $line = StringHelper::transliterate($line);
            $line = StringHelper::lower($line);

            if ($this->isRankLine($line)) {
                $rank++;
                $data[$rank] = $data[$rank] ?? [];
                continue;
            }

            if ($this->isSkillGroupLine($line)) {
                $data[$rank][] = [
                    'key' => StringHelper::key(explode(' ', $line)[0]),
                    'type' => 'skill_group',
                ];
                continue;
            }

            if ($this->isSkillLine($line)) {
                $matches = [];
                preg_match('/(.*?) skill/', $line, $matches);

                $data[$rank][] = [
                    'key' => StringHelper::key($matches[1]),
                    'type' => 'skill',
                ];

                continue;
            }

            if ($this->isTechniqueSubtypeLine($line)) {
                $min = 1;
                $max = 1;
                if ($this->hasRankRange($line)) {
                    $matches = [];
                    preg_match('/([1-5])-([1-5])/', $line, $matches);
                    $min = (int) $matches[1];
                    $max = (int) $matches[2];
                } else {
                    $matches = [];
                    preg_match('/([1-5])/', $line, $matches);
                    $min = (int) $matches[1];
                    $max = $min;
                }

                $matches = [];
                preg_match('/\d ((air|earth|fire|water|void) (shuji|invocations|kiho))/', $line, $matches);

                $data[$rank][] = [
                    'key' => StringHelper::key($matches[1]),
                    'type' => 'technique_subtype',
                    'min' => $min,
                    'max' => $max,
                ];
                continue;
            }

            if ($this->isTechniqueTypeLine($line)) {
                $min = 1;
                $max = 1;
                if ($this->hasRankRange($line)) {
                    $matches = [];
                    preg_match('/([1-5])-([1-5])/', $line, $matches);
                    $min = (int) $matches[1];
                    $max = (int) $matches[2];
                } else {
                    $matches = [];
                    preg_match('/([1-5])/', $line, $matches);
                    $min = (int) $matches[1];
                    $max = $min;
                }

                $matches = [];
                preg_match('/\d (general kata|ranged kata|kata|kiho|invocations|rituals|shuji)/', $line, $matches);
                $data[$rank][] = [
                    'key' => StringHelper::key($matches[1]),
                    'type' => 'technique_type',
                    'min' => $min,
                    'max' => $max,
                ];
                continue;
            }

            if ($this->isTechniqueLine($line)) {
                $ignoreRequirements = $line[0] === '=';

                $matches = [];
                preg_match('/(= )?(.*) \?/', $line, $matches);
                $data[$rank][] = [
                    'key' => StringHelper::key($matches[2]),
                    'type' => 'technique',
                    'ignore_requirements' => $ignoreRequirements,
                ];
                continue;
            }
        }

        return $data;
    }


    private function isRankLine(string $line): bool
    {
        return preg_match('/^rank [1-5]$/', $line) === 1;
    }


    private function isSkillGroupLine(string $line): bool
    {
        return preg_match('/(.*?)skl. grp.$/', $line) === 1;
    }


    private function isSkillLine(string $line): bool
    {
        return preg_match('/(.*?)skill$/', $line) === 1;
    }


    private function isTechniqueGroupLine(string $line): bool
    {
        return preg_match('/(.*?)tech. grp.$/', $line) === 1;
    }


    private function isTechniqueSubtypeLine(string $line): bool
    {
        if (!$this->isTechniqueGroupLine($line)) {
            return false;
        }

        return preg_match('/rank (.*)-?(.*?) (air|earth|fire|void|water) (shuji|invocations|kiho)/', $line) === 1;
    }


    private function isTechniqueTypeLine(string $line): bool
    {
        if (!$this->isTechniqueGroupLine($line)) {
            return false;
        }

        return preg_match('/rank (.*)-?(.*?) (kata|kiho|invocations|rituals|shuji)/', $line) === 1;
    }


    private function hasRankRange(string $line): bool
    {
        return preg_match('/([1-5])-([1-5])/', $line) === 1;
    }


    private function isTechniqueLine(string $line): bool
    {
        return preg_match('/(.*?)technique$/', $line) === 1;
    }
}
