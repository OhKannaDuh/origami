<?php

namespace Tests\Unit;

use App\StringHelper;
use Tests\TestCase;

final class StringHelperTest extends TestCase
{


    public function providerKey(): array
    {
        return [
            ['Some Key', 'some_key'],
            ['A Test (just so you know)', 'a_test_just_so_you_know'],
            ['Hello: The tale of adventure', 'hello_the_tale_of_adventure'],
            ['Open-hand Style', 'open_hand_style'],
        ];
    }


    /**
     * Ensure our string helper key-ifies words as expected.
     *
     * @dataProvider providerKey
     *
     * @param string $input
     * @param string $expected
     */
    public function testKey(string $input, string $expected): void
    {
        $output = StringHelper::key($input);
        self::assertSame($expected, $output);
    }


    public function providerWordToNumber(): array
    {
        return [
            ['one', 1],
            ['two', 2],
            ['three', 3],
            ['four', 4],
            ['five', 5],
            ['six', 6],
            ['seven', 7],
            ['eight', 8],
            ['nine', 9],
            ['ten', -1],
        ];
    }


    /**
     * Ensure we can convert words to numbers.
     *
     * @dataProvider providerWordToNumber
     *
     * @param string $input
     * @param integer $expected
     */
    public function testWordToNumber(string $input, int $expected): void
    {
        $output = StringHelper::wordToNumber($input);
        self::assertSame($expected, $output);
    }
}
