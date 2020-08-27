<?php

namespace PhoneBurnerTest\Http\Message;

use PHPUnit\Framework\TestCase;

abstract class EvolvingWrapperTestCase extends WrapperTestCase
{
    abstract public function provideWithMethods(): iterable;

    /**
     * @test
     * @dataProvider provideWithMethods
     */
    public function withMethodsAreProxied(string $method, array $args, array $expected = null): void
    {
        // allow expected args to differ from the args we pass the wrapper
        // but if they're not defined, they are the same as what is passed to
        // the wrapper
        if (null === $expected) {
            $expected = $args;
        }

        $fixture_class = static::FIXTURE_CLASS;
        $return = $this->prophesize(static::WRAPPED_CLASS)->reveal();
        $this->mocked_wrapped->$method(...$expected)->willReturn($return)->shouldBeCalled();
        $sut = new $fixture_class($this->mocked_wrapped->reveal());
        self::assertSame($return, $sut->$method(...$args));
    }

    /**
     * @test
     * @dataProvider provideWithMethods
     */
    public function withMethodsUseFactoryWhenProvided($method, $args, array $expected = null): void
    {
        // allow expected args to differ from the args we pass the wrapper
        // but if they're not defined, they are the same as what is passed to
        // the wrapper
        if (null === $expected) {
            $expected = $args;
        }

        $fixture_class = static::FIXTURE_CLASS;

        $return = $this->prophesize(static::WRAPPED_CLASS)->reveal();
        $wrapped = $this->prophesize(static::FIXTURE_CLASS)->reveal();

        $this->mocked_wrapped->$method(...$expected)->willReturn($return)->shouldBeCalled();

        $sut = new $fixture_class($this->mocked_wrapped->reveal(), function ($message) use ($return, $wrapped) {
            TestCase::assertSame($return, $message);
            return $wrapped;
        });

        self::assertSame($wrapped, $sut->$method(...$args));
    }
}
