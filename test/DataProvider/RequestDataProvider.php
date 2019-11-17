<?php
namespace PhoneBurnerTest\Http\Message\DataProvider;

use PhoneBurnerTest\Http\Message\DataProvider\MessageDataProvider;
use Psr\Http\Message\UriInterface;

trait RequestDataProvider
{
    use MessageDataProvider {
        provideGetterMethods as provideMessageGetterMethods;
        provideWithMethods as provideMessageWithMethods;
    }

    public function provideGetterMethods(): \Generator
    {
        foreach ($this->provideMessageGetterMethods() as $label => $data) {
            yield $label => $data;
        }

        yield "getRequestTarget()" => ['getRequestTarget', [], '*'];

        yield "getMethod() => POST" => ['getMethod', [], 'POST'];
        yield "getMethod() => GET" => ['getMethod', [], 'GET'];
        yield "getMethod() => PUT" => ['getMethod', [], 'PUT'];
        yield "getMethod() => DELETE" => ['getMethod', [], 'DELETE'];

        $uri = $this->prophesize(UriInterface::class)->reveal();

        yield "getUri()" => ['getUri', [], $uri];
    }

    public function provideWithMethods(): \Generator
    {
        foreach ($this->provideMessageWithMethods() as $label => $data) {
            yield $label => $data;
        }

        yield "withRequestTarget(*)" => ['withRequestTarget', ['*']];

        yield "withMethod('POST')" => ['withMethod', ['POST']];
        yield "withMethod('GET')" => ['withMethod', ['GET']];
        yield "withMethod('PUT')" => ['withMethod', ['PUT']];
        yield "withMethod('DELETE')" => ['withMethod', ['DELETE']];

        $uri = $this->prophesize(UriInterface::class)->reveal();

        yield "withUri(\$uri)" => ['withUri', [$uri], [$uri, false]];
        yield "withUri(\$uri, false)" => ['withUri', [$uri, false]];
        yield "withUri(\$uri, true)" => ['withUri', [$uri, true]];
    }
}