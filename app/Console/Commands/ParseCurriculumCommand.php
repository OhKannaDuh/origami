<?php

namespace App\Console\Commands;

use App\StringHelper;
use Illuminate\Console\Command;

use function PHPUnit\Framework\matches;

final class ParseCurriculumCommand extends Command
{
    protected $signature = 'curriculum:parse';

    protected $description = 'Parse a curriculum from a source book as plain text to creation notaion for a school';


    public function handle(): bool
    {
        $input = file_get_contents(base_path('/input.txt'));
        $data = $this->getData($input);

        $output = '(new Curriculum())';
        foreach ($data as $rank => $ranks) {
            $output .= PHP_EOL . "\t->withRank({$rank}, (new CurriculumRank())";

            foreach ($ranks as $datum) {
                if ($datum['type'] === 'skill_group') {
                    $output .= PHP_EOL . "\t\t->withSkillGroup('{$datum['key']}')";
                }

                if ($datum['type'] === 'skill') {
                    $output .= PHP_EOL . "\t\t->withSkill('{$datum['key']}')";
                }

                if ($datum['type'] === 'technique_type') {
                    $output .= PHP_EOL . "\t\t->withTechniqueType('{$datum['key']}', {$datum['min']}, {$datum['max']})";
                }

                if ($datum['type'] === 'technique_subtype') {
                    $output .= PHP_EOL . "\t\t->withTechniqueSubtype('{$datum['key']}', {$datum['min']}, {$datum['max']})";
                }

                if ($datum['type'] === 'technique') {
                    $line = PHP_EOL . "\t\t->withTechnique('{$datum['key']}'";
                    if ($datum['ignore_requirements']) {
                        $line .= ', true';
                    }

                    $line .= ')';
                    $output .= $line;
                }
            }

            $output .= ')';
        }
        $output .= ',';

        file_put_contents(base_path('/output.txt'), $output);

        return true;
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
                preg_match('/\d (kata|kiho|invocations|rituals|shuji)/', $line, $matches);

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
