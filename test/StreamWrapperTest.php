<?php
declare(strict_types=1);

namespace PhoneBurnerTest\Http\Message;

use PhoneBurnerTest\Http\Message\Fixture\StreamWrapperFixture;
use Psr\Http\Message\StreamInterface;

class StreamWrapperTest extends WrapperTestCase
{
    protected const WRAPPED_CLASS = StreamInterface::class;
    protected const FIXTURE_CLASS = StreamWrapperFixture::class;

    /**
     * @test
     */
    public function closeIsProxied(): void
    {
        $fixture_class = static::FIXTURE_CLASS;
        $this->mocked_wrapped->close()->shouldBeCalled();
        $sut = new $fixture_class($this->mocked_wrapped->reveal());
        $sut->close();
    }

    /**
     * @test
     */
    public function detachIsProxied(): void
    {
        $fixture_class = static::FIXTURE_CLASS;
        $this->mocked_wrapped->detach()->shouldBeCalled()->willReturn(null);
        $sut = new $fixture_class($this->mocked_wrapped->reveal());
        self::assertNull($sut->detach());

        $fixture_class = static::FIXTURE_CLASS;
        $resource = fopen('php://temp', 'r');
        $this->mocked_wrapped->detach()->shouldBeCalled()->willReturn($resource);
        $sut = new $fixture_class($this->mocked_wrapped->reveal());
        self::assertSame($resource, $sut->detach());
        fclose($resource);
    }

    /**
     * @test
     * @dataProvider provideSeekArgs
     */
    public function seekIsProxied($offset, $whence): void
    {
        $fixture_class = static::FIXTURE_CLASS;
        $this->mocked_wrapped->seek($offset, $whence)->shouldBeCalled();
        $sut = new $fixture_class($this->mocked_wrapped->reveal());
        $sut->seek($offset, $whence);
    }

    public function provideSeekArgs(): iterable
    {
        yield [10, SEEK_CUR];
        yield [10, SEEK_END];
        yield [10, SEEK_SET];
        yield [10, null];
    }

    /**
     * @test
     */
    public function rewindIsProxied(): void
    {
        $fixture_class = static::FIXTURE_CLASS;
        $this->mocked_wrapped->rewind()->shouldBeCalled();
        $sut = new $fixture_class($this->mocked_wrapped->reveal());
        $sut->rewind();
    }

    /**
     * @test
     */
    public function writeIsProxied(): void
    {
        $fixture_class = static::FIXTURE_CLASS;
        $this->mocked_wrapped->write('test')->willReturn(10);
        $sut = new $fixture_class($this->mocked_wrapped->reveal());
        self::assertSame(10, $sut->write('test'));
    }

    public function provideAllMethods(): iterable
    {
        yield from $this->provideGetterMethods();
    }

    public function provideGetterMethods(): iterable
    {
        yield "getSize (null)" => ['getSize', [], null];
        yield "getSize" => ['getSize', [], 100];
        yield "tell" => ['getSize', [], 10];
        yield "eof (true)" => ['eof', [], true];
        yield "eof (false)" => ['eof', [], false];
        yield "isSeekable (false)" => ['isSeekable', [], false];
        yield "isSeekable (true)" => ['isSeekable', [], true];
        yield "isWritable (false)" => ['isWritable', [], false];
        yield "isWritable (true)" => ['isWritable', [], true];
        yield "isReadable (false)" => ['isReadable', [], false];
        yield "isReadable (true)" => ['isReadable', [], true];
        yield "read" => ['read', [10], 'test'];
        yield "getContents" => ['getContents', [], 'content'];
        yield "getMetadata (null)" => ['getMetadata', [null], ['key' => 'value']];
        yield "getMetadata (key)" => ['getMetadata', ['key'], 'value'];
        yield "getMetadata (invalid key)" => ['getMetadata', ['not_key'], null];
        yield "__toString" => ['__toString', [], 'content'];
    }
}
