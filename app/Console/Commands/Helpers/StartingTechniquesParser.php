<?php

namespace App\Console\Commands\Helpers;

use App\StringHelper;
use Illuminate\Support\Arr;

use function PHPUnit\Framework\matches;

final class StartingTechniquesParser
{


    public function parse(array $lines): array
    {
        $startingTechniqueLines = [];
        $start = false;
        $data = [];

        foreach ($lines as $line) {
            $line = StringHelper::transliterate($line);

            if (preg_match('/Starting Techniques:/', $line) === 1) {
                $start = true;
            }

            if (preg_match('/.* \(School Ability\):/', $line) === 1) {
                $line = implode(' ', $startingTechniqueLines);
                $line = StringHelper::after($line, ': ');

                $groups = explode('$', $line);
                foreach ($groups as $group) {
                    $group = trim($group);
                    if ($group === '') {
                        continue;
                    }

                    $amount = 0;
                    $descriptor = StringHelper::before($group, ': ');
                    $matches = [];
                    if (preg_match('/(.*) \(choose (.*)\)/', $descriptor, $matches) === 1) {
                        $amount = StringHelper::wordToNumber($matches[2]);
                    }

                    $skills = StringHelper::replace('= ', '', $group);
                    $skills = StringHelper::after($skills, ': ');
                    $skills = explode(', ', $skills);
                    $skills = Arr::map($skills, fn (string $skill): string => StringHelper::key($skill));

                    $datum = [
                        'keys' => $skills,
                    ];

                    if ($amount > 0) {
                        $datum['amount'] = $amount;
                    }


                    $data[$matches[1] ?? $descriptor] = $datum;
                }


                return [
                    'starting_techniques' => $data,
                ];
            }

            if ($start) {
                $startingTechniqueLines[] = $line;
            }
        }

        return [];
    }
}
