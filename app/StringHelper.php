<?php

namespace App;

use Illuminate\Support\Str;

final class StringHelper extends Str
{
    private const KEY_REMOVE = [
        ',',
        '\'',
        ':',
        '(',
        ')',
        '[',
        ']',
    ];


    public static function key(string $subject): string
    {
        return self::of($subject)->replace('-', '_')->remove(self::KEY_REMOVE)->lower()->snake();
    }


    public static function wordToNumber(string $subject): int
    {
        return match ($subject) {
            'one' => 1,
            'two' => 2,
            'three' => 3,
            'four' => 4,
            'five' => 5,
            'six' => 6,
            'seven' => 7,
            'eight' => 8,
            'nine' => 9,
            default => - 1,
        };
    }
}
