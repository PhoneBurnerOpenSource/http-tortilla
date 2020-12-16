<?php
declare(strict_types=1);

namespace PhoneBurnerTest\Http\Message\DataProvider;

use Generator;

trait ResponseDataProvider
{
    use MessageDataProvider {
        provideGetterMethods as provideMessageGetterMethods;
        provideWithMethods as provideMessageWithMethods;
    }

    public function provideGetterMethods(): Generator
    {
        yield from $this->provideMessageGetterMethods();

        yield "getStatusCode()" => ['getStatusCode', [], 200];
        yield "getReasonPhrase() => ''" => ['getReasonPhrase', [], ''];
        yield "getReasonPhrase() => 'OK'" => ['getReasonPhrase', [], 'OK'];
    }

    public function provideWithMethods(): Generator
    {
        yield from $this->provideMessageWithMethods();

        yield "withStatus(200)" => ['withStatus', [200], [200, '']];
        yield "withStatus(200, '')" => ['withStatus', [200, '']];
        yield "withStatus(200, 'OK')" => ['withStatus', [200, 'OK']];
    }
}
