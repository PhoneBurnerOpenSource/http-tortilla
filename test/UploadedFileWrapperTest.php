<?php

namespace PhoneBurnerTest\Http\Message;

use PhoneBurnerTest\Http\Message\Fixture\UploadedFileWrapperFixture;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;

class UploadedFileWrapperTest extends WrapperTestCase
{
    protected const WRAPPED_CLASS = UploadedFileInterface::class;
    protected const FIXTURE_CLASS = UploadedFileWrapperFixture::class;

    /**
     * @test
     */
    public function moveToRequiresWrappedClass(): void
    {
        $fixture_class = self::FIXTURE_CLASS;
        $sut = new $fixture_class();
        $this->expectException(\UnexpectedValueException::class);
        $sut->moveTo('path');
    }

    /**
     * @test
     */
    public function moveToPassesTargetToWrappedClass(): void
    {
        $fixture_class = self::FIXTURE_CLASS;
        $this->mocked_wrapped->moveTo('path')->shouldBeCalled();

        $sut = new $fixture_class($this->mocked_wrapped->reveal());
        $sut->moveTo('path');
    }

    /**
     * @test
     */
    public function moveToIgnoresWrappedResponse(): void
    {
        $fixture_class = self::FIXTURE_CLASS;
        $this->mocked_wrapped->moveTo('path')->willReturn('something');

        $sut = new $fixture_class($this->mocked_wrapped->reveal());
        self::assertNull($sut->moveTo('path'));
    }

    /**
     * @test
     * @testWith ["\\InvalidArgumentException"]
     *           ["\\RuntimeException"]
     */
    public function moveToCatchesNoExceptions($class): void
    {
        $fixture_class = self::FIXTURE_CLASS;
        $this->mocked_wrapped->moveTo('path')->willThrow(new $class());

        $sut = new $fixture_class($this->mocked_wrapped->reveal());
        $this->expectException($class);
        $sut->moveTo('path');
    }

    public function provideAllMethods(): iterable
    {
        yield from $this->provideGetterMethods();
    }

    public function provideGetterMethods(): iterable
    {
        $stream = $this->prophesize(StreamInterface::class);
        yield "getStream()" => ['getStream', [], $stream->reveal()];

        yield "getSize() => 1" => ['getSize', [], 1];
        yield "getSize() => null" => ['getSize', [], null];

        yield "getError()" => ['getError', [], 1];

        yield "getClientFilename() => 'filename'" => ['getClientFilename', [], 'filename'];
        yield "getClientFilename() => null" => ['getClientFilename', [], null];

        yield "getClientMediaType() => 'type'" => ['getClientMediaType', [], 'type'];
        yield "getClientMediaType() => null" => ['getClientMediaType', [], null];
    }
}
