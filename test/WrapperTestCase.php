<?php

namespace PhoneBurnerTest\Http\Message;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

abstract class WrapperTestCase extends TestCase
{
    abstract public function provideAllMethods(): \Generator;
    abstract public function provideGetterMethods(): \Generator;
    abstract public function provideWithMethods(): \Generator;

    /**
     * @var ObjectProphecy
     */
    protected $mocked_wrapped;

    public function setUp(): void
    {
        $this->mocked_wrapped = $this->prophesize(static::WRAPPED_CLASS);
    }

    /**
     * @test
     * @dataProvider provideAllMethods
     */
    public function proxiedMethodsRequireWrappedClass($method, $args): void
    {
        $fixture_class = static::FIXTURE_CLASS;
        $sut = new $fixture_class();
        $this->expectException(\UnexpectedValueException::class);
        $sut->$method(...$args);
    }

    /**
     * @test
     * @dataProvider provideGetterMethods
     */
    public function getterMethodsAreProxied(string $method, array $args, $return, array $expected = null): void
    {
        // allow expected args to differ from the args we pass the wrapper
        // but if they're not defined, they are the same as what is passed to
        // the wrapper
        if (null === $expected) {
            $expected = $args;
        }

        $fixture_class = static::FIXTURE_CLASS;
        $this->mocked_wrapped->$method(...$expected)->willReturn($return);
        $sut = new $fixture_class($this->mocked_wrapped->reveal());
        $this->assertSame($return, $sut->$method(...$args));
    }

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
        $this->assertSame($return, $sut->$method(...$args));
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
        $wrapped = $this->prophesize(static::WRAPPED_CLASS)->reveal();

        $this->mocked_wrapped->$method(...$expected)->willReturn($return)->shouldBeCalled();

        $sut = new $fixture_class($this->mocked_wrapped->reveal(), function ($message) use ($return, $wrapped) {
            TestCase::assertSame($return, $message);
            return $wrapped;
        });

        $this->assertSame($wrapped, $sut->$method(...$args));
    }
}