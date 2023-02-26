<?php

namespace App\Console\Commands\Helpers;

use App\StringHelper;

final class StartingOutfitParser
{


    public function parse(array $lines): array
    {
        $outfit = [];
        $start = false;

        foreach ($lines as $line) {
            $line = StringHelper::transliterate($line);

            if (preg_match('/Starting Outfit:/', $line) === 1) {
                $start = true;
            }

            if ($start && preg_match('/.*\.$/', $line) === 1) {
                $outfit[] = $line;
                $outfit = implode(' ', $outfit);
                $outfit = StringHelper::beforeLast($outfit, '.');

                return [
                    'starting_outfit' => explode(', ', StringHelper::after($outfit, ': ')),
                ];
            }

            if ($start) {
                $outfit[] = $line;
            }
        }

        return [];
    }
}
