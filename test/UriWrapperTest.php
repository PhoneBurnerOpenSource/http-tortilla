<?php

declare(strict_types=1);

namespace PhoneBurnerTest\Http\Message;

use PhoneBurnerTest\Http\Message\Fixture\UriWrapperFixture;
use Psr\Http\Message\UriInterface;

class UriWrapperTest extends EvolvingWrapperTestCase
{
    protected const WRAPPED_CLASS = UriInterface::class;
    protected const FIXTURE_CLASS = UriWrapperFixture::class;

    public function provideAllMethods(): iterable
    {
        yield from $this->provideWithMethods();
        yield from $this->provideGetterMethods();
    }

    public function provideGetterMethods(): iterable
    {
        yield "getScheme" => ['getScheme', [], 'http'];
        yield "getAuthority (none)" => ['getAuthority', [], ''];
        yield "getAuthority" => ['getAuthority', [], 'user:info@host:80'];
        yield "getUserInfo" => ['getUserInfo', [], 'user:info'];
        yield "getHost" => ['getHost', [], 'host'];
        yield "getPort" => ['getPort', [], 80];
        yield "getPort (null)" => ['getPort', [], null];
        yield "getPath" => ['getPath', [], '/path'];
        yield "getQuery" => ['getQuery', [], 'query'];
        yield "getFragment" => ['getFragment', [], 'fragment'];
        yield "__toString" => ['__toString', [], 'http://example.com/test'];
    }

    public function provideWithMethods(): iterable
    {
        yield "withScheme" => ['withScheme', ['https']];
        yield "withUserInfo (user only)" => ['withUserInfo', ['nopass', null]];
        yield "withUserInfo (user and password)" => ['withUserInfo', ['with', 'pass']];
        yield "withHost" => ['withHost', ['example.com']];
        yield "withPort" => ['withPort', [8080]];
        yield "withPort (null)" => ['withPort', [null]];
        yield "withPath" => ['withPath', ['path']];
        yield "withQuery" => ['withQuery', ['query']];
        yield "withFragment" => ['withFragment', ['fragment']];
    }
}
