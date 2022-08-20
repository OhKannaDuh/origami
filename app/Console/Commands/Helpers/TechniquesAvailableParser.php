<?php

namespace App\Console\Commands\Helpers;

use App\StringHelper;
use Illuminate\Support\Arr;

final class TechniquesAvailableParser
{


    public function parse(array $lines): array
    {
        foreach ($lines as $line) {
            $line = StringHelper::transliterate($line);

            if (preg_match('/Techniques Available: (.*)/', $line) === 1) {

                $line = StringHelper::after($line, ': ');
                $line = StringHelper::replace('(?)', '', $line);
                $techniques = explode(', ', $line);
                $techniques = Arr::map($techniques, fn (string $type): string => trim($type));

                return [
                    'techniques_available' => Arr::map($techniques, fn (string $type): string => StringHelper::key($type)),
                ];
            }
        }

        return [];
    }
}
