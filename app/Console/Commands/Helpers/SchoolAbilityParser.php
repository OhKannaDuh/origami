<?php

namespace App\Console\Commands\Helpers;

use App\StringHelper;

final class SchoolAbilityParser
{


    public function parse(array $lines): array
    {
        foreach ($lines as $line) {
            $line = StringHelper::transliterate($line);

            $matches = [];
            if (preg_match('/(.*) \(School Ability\):/', $line, $matches) === 1) {
                return [
                    'school_ability' => $matches[1],
                ];
            }
        }

        return [];
    }
}
