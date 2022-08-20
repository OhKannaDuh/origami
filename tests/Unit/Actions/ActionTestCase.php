<?php

namespace Tests\Unit\Actions;

use App\Actions\ActionInterface;
use App\StringHelper;
use AssertionError;
use Tests\TestCase;

abstract class ActionTestCase extends TestCase
{


    abstract protected function getAction(): ActionInterface;


    abstract public function providerContextException(): array;


    /**
     * @dataProvider providerContextException
     */
    public function testContextException(string $key, string $expected, array $context): void
    {
        $this->expectInvalidContext($key, $expected);


        $this->getAction()->execute($context);
        $this->getAction()->execute(array_merge($context, [$key => null]));
    }


    protected function expectInvalidContext(string $key, string $expected): void
    {
        $expected = StringHelper::afterLast($expected, '\\');

        $this->expectException(AssertionError::class);
        $this->expectErrorMessage("assert(\${$key} instanceof {$expected})");
    }
}
