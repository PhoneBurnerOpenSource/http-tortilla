<?php

namespace PhoneBurnerTest\Http\Message\DataProvider;

use Generator;
use Psr\Http\Message\UploadedFileInterface;

trait ServerRequestDataProvider
{
    use RequestDataProvider {
        provideGetterMethods as provideRequestGetterMethods;
        provideWithMethods as provideRequestWithMethods;
    }

    public function provideGetterMethods(): Generator
    {
        yield from $this->provideRequestGetterMethods();

        $params = [
            'key' => 'value',
            'another_key' => 'another_value',
        ];

        yield "getServerParams()" => ['getServerParams', [], $params];
        yield "getCookieParams()" => ['getCookieParams', [], $params];
        yield "getQueryParams()" => ['getQueryParams', [], $params];

        $files = [
            'test' => $this->prophesize(UploadedFileInterface::class)->reveal(),
            'test2' => $this->prophesize(UploadedFileInterface::class)->reveal(),
        ];

        yield "getUploadedFiles() => \$files" => ['getUploadedFiles', [], $files];

        yield "getParsedBody() => null" => ['getParsedBody', [], null];
        yield "getParsedBody() => \$params" => ['getParsedBody', [], $params];
        yield "getParsedBody() => (object) \$params" => ['getParsedBody', [], (object) $params];

        $attributes = [
            'user' => '1234',
            'test' => true,
            'obj' => new \stdClass(),
        ];

        yield "getAttributes() => \$attributes" => ['getAttributes', [], $attributes];

        yield "getAttribute('user')" => ['getAttribute', ['user'], $attributes['user'], ['user', null]];
        yield "getAttribute('test')" => ['getAttribute', ['user'], $attributes['test'], ['user', null]];
        yield "getAttribute('obj')" => ['getAttribute', ['user'], $attributes['obj'], ['user', null]];

        yield "getAttribute('user', null)" => ['getAttribute', ['user', null], $attributes['user']];
        yield "getAttribute('test', null)" => ['getAttribute', ['user', null], $attributes['test']];
        yield "getAttribute('obj', null)" => ['getAttribute', ['user', null], $attributes['obj']];

        yield "getAttribute('user', 'test')" => ['getAttribute', ['user', 'test'], 'test'];
        yield "getAttribute('test', 'test')" => ['getAttribute', ['user', 'test'], 'test'];
        yield "getAttribute('obj', 'test')" => ['getAttribute', ['user', 'test'], 'test'];
    }

    public function provideWithMethods(): Generator
    {
        yield from $this->provideRequestWithMethods();

        $params = [
            'key' => 'value',
            'another_key' => 'another_value',
        ];

        yield "withCookieParams(\$params)" => ['withCookieParams', [$params]];
        yield "withQueryParams(\$params)" => ['withQueryParams', [$params]];

        $files = [
            'test' => $this->prophesize(UploadedFileInterface::class)->reveal(),
            'test2' => $this->prophesize(UploadedFileInterface::class)->reveal(),
        ];

        yield "withUploadedFiles(\$params)" => ['withUploadedFiles', [$files]];

        yield "withParsedBody(null)" => ['withParsedBody', [null]];
        yield "withParsedBody(\$params)" => ['withParsedBody', [$params]];
        yield "withParsedBody((object) \$params)" => ['withParsedBody', [(object) $params]];

        yield "withAttribute('test', 'value')" => ['withAttribute', ['test', 'value']];
        yield "withoutAttribute('test')" => ['withoutAttribute', ['test']];
    }
}
