<?php

namespace App\Console\Commands\Helpers;

use App\StringHelper;

final class MasteryAbilityParser
{


    public function parse(array $lines): array
    {
        foreach ($lines as $line) {
            $line = StringHelper::transliterate($line);

            $matches = [];
            if (preg_match('/(.*) \(Mastery Ability\):/', $line, $matches) === 1) {
                return [
                    'mastery_ability' => StringHelper::after($matches[1], 'RANK 6 '),
                ];
            }
        }

        return [];
    }
}
