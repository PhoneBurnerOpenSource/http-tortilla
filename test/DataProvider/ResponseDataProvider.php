<?php

namespace PhoneBurnerTest\Http\Message\DataProvider;

use PhoneBurnerTest\Http\Message\DataProvider\MessageDataProvider;
use Psr\Http\Message\UriInterface;

trait ResponseDataProvider
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

        yield "getStatusCode()" => ['getStatusCode', [], 200];
        yield "getReasonPhrase() => ''" => ['getReasonPhrase', [], ''];
        yield "getReasonPhrase() => 'OK'" => ['getReasonPhrase', [], 'OK'];
    }

    public function provideWithMethods(): \Generator
    {
        foreach ($this->provideMessageWithMethods() as $label => $data) {
            yield $label => $data;
        }

        yield "withStatus(200)" => ['withStatus', [200], [200, '']];
        yield "withStatus(200, '')" => ['withStatus', [200, '']];
        yield "withStatus(200, 'OK')" => ['withStatus', [200, 'OK']];
    }
}
