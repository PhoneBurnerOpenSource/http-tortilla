<?php

namespace PhoneBurnerTest\Http\Message;

use PhoneBurnerTest\Http\Message\DataProvider\RequestDataProvider;
use PhoneBurnerTest\Http\Message\Fixture\RequestWrapperFixture;
use Psr\Http\Message\RequestInterface;

class RequestWrapperTest extends WrapperTestCase
{
    use RequestDataProvider;

    protected const WRAPPED_CLASS = RequestInterface::class;
    protected const FIXTURE_CLASS = RequestWrapperFixture::class;
}
