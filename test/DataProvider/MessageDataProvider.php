<?php

namespace PhoneBurnerTest\Http\Message\DataProvider;

use Psr\Http\Message\StreamInterface;

trait MessageDataProvider
{
    public function provideAllMethods(): \Generator
    {
        foreach ($this->provideWithMethods() as $label => $data) {
            yield $label => $data;
        }

        foreach ($this->provideGetterMethods() as $label => $data) {
            yield $label => $data;
        }
    }

    public function provideGetterMethods(): \Generator
    {
        yield "getProtocolVersion() => '1.1'" => ['getProtocolVersion', [], '1.1'];
        yield "getProtocolVersion() => '1.0'" => ['getProtocolVersion', [], '1.0'];

        $header = [
            'line one',
            'line two',
        ];

        $headers = [
            'test' => $header,
        ];

        yield "getHeaders()" => ['getHeaders', [], $headers];
        yield "getHeader('test)" => ['getHeader', ['test'], $header];

        yield "hasHeader('test) => true" => ['hasHeader', ['test'], true];
        yield "hasHeader('test) => false" => ['hasHeader', ['test'], false];

        yield "getHeaderLine('test)" => ['getHeaderLine', ['test'], 'line one, line two'];

        $body = $this->prophesize(StreamInterface::class)->reveal();

        yield "getBody()" => ['getBody', [], $body];
    }

    public function provideWithMethods(): \Generator
    {
        yield "withProtocolVersion('1.1')" => ['withProtocolVersion', ['1.1']];
        yield "withProtocolVersion('1.0')" => ['withProtocolVersion', ['1.0']];

        yield "withHeader('test', 'line one')" => ['withHeader', ['test', 'line one']];
        yield "withHeader('test', ['line one'])" => ['withHeader', ['test', ['line one']]];
        yield "withHeader('test', ['line one', 'line two'])" => ['withHeader', ['test', ['line one', 'line two']]];

        yield "withAddedHeader('test', 'line one')" => ['withAddedHeader', ['test', 'line one']];
        yield "withAddedHeader('test', ['line one'])" => ['withAddedHeader', ['test', ['line one']]];
        yield "withAddedHeader('test', ['line one', 'line two'])" => ['withAddedHeader', ['test', ['line one', 'line two']]];

        yield "withoutHeader('test')" => ['withoutHeader', ['test']];

        $body = $this->prophesize(StreamInterface::class)->reveal();
        yield "withBody(StreamInterface)" => ['withBody', [$body]];
    }
}
