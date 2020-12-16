<?php

namespace PhoneBurnerTest\Http\Message\DataProvider;

use Generator;
use Psr\Http\Message\UriInterface;

trait RequestDataProvider
{
    use MessageDataProvider {
        provideGetterMethods as provideMessageGetterMethods;
        provideWithMethods as provideMessageWithMethods;
    }

    public function provideGetterMethods(): Generator
    {
        yield from $this->provideMessageGetterMethods();

        yield "getRequestTarget()" => ['getRequestTarget', [], '*'];

        yield "getMethod() => POST" => ['getMethod', [], 'POST'];
        yield "getMethod() => GET" => ['getMethod', [], 'GET'];
        yield "getMethod() => PUT" => ['getMethod', [], 'PUT'];
        yield "getMethod() => DELETE" => ['getMethod', [], 'DELETE'];

        $uri = $this->prophesize(UriInterface::class)->reveal();

        yield "getUri()" => ['getUri', [], $uri];
    }

    public function provideWithMethods(): Generator
    {
        yield from $this->provideMessageWithMethods();

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
