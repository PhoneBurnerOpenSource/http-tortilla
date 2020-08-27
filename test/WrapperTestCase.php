<?php

namespace PhoneBurnerTest\Http\Message;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

abstract class WrapperTestCase extends TestCase
{
    abstract public function provideAllMethods(): \Generator;
    abstract public function provideGetterMethods(): \Generator;

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
        self::assertSame($return, $sut->$method(...$args));
    }
}
