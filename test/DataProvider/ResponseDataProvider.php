<?php

namespace PhoneBurnerTest\Http\Message\DataProvider;

trait ResponseDataProvider
{
    use MessageDataProvider {
        provideGetterMethods as provideMessageGetterMethods;
        provideWithMethods as provideMessageWithMethods;
    }

    public function provideGetterMethods(): iterable
    {
        yield from $this->provideMessageGetterMethods();

        yield "getStatusCode()" => ['getStatusCode', [], 200];
        yield "getReasonPhrase() => ''" => ['getReasonPhrase', [], ''];
        yield "getReasonPhrase() => 'OK'" => ['getReasonPhrase', [], 'OK'];
    }

    public function provideWithMethods(): iterable
    {
        yield from $this->provideMessageWithMethods();

        yield "withStatus(200)" => ['withStatus', [200], [200, '']];
        yield "withStatus(200, '')" => ['withStatus', [200, '']];
        yield "withStatus(200, 'OK')" => ['withStatus', [200, 'OK']];
    }
}
