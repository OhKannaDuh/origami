<?php

namespace App\Console\Commands\Helpers;

use App\StringHelper;

final class HonorParser
{


    public function parse(array $lines): array
    {
        foreach ($lines as $line) {
            $line = StringHelper::transliterate($line);

            if (preg_match('/Honor: [0-9]*/', $line) === 1) {
                $matches = [];
                preg_match('/Honor: ([0-9]*)/', $line, $matches);
                return [
                    'honor' => (int) $matches[1],
                ];
            }
        }

        return [];
    }
}
