<?php

namespace App\Console\Commands\Helpers;

use App\StringHelper;
use Illuminate\Support\Arr;

final class NameParser
{


    public function parse(array $lines): array
    {
        $nameLines = [];

        foreach ($lines as $line) {
            $line = StringHelper::transliterate($line);
            $nameLines[] = $line;

            if (preg_match('/(.*)\]/', $line) == 1) {
                $nameLine = implode(' ', $nameLines);
                $types = StringHelper::of($nameLine)->before(']')->after('[')->toString();
                $types = explode(', ', $types);

                return [
                    'name' => StringHelper::of($nameLine)->beforeLast('[')->trim()->toString(),
                    'types' => Arr::map($types, fn (string $type): string => StringHelper::key($type)),
                ];
            }
        }

        return [];
    }
}
