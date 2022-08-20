<?php

namespace App\Console\Commands\Helpers;

use App\StringHelper;

final class RingParser
{


    public function parse(array $lines): array
    {
        foreach ($lines as $line) {
            $line = StringHelper::transliterate($line);

            if (preg_match('/Rings: \+1 (.*), \+1 (.*)/', $line) === 1) {
                $matches = [];
                preg_match('/Rings: \+1 (.*), \+1 (.*)/', $line, $matches);

                return [
                    'ring_one' => StringHelper::key($matches[1]),
                    'ring_two' => StringHelper::key($matches[2]),
                ];
            }
        }

        return [];
    }
}
