<?php

namespace PhoneBurnerTest\Http\Message;

use PhoneBurnerTest\Http\Message\DataProvider\ServerRequestDataProvider;
use PhoneBurnerTest\Http\Message\Fixture\ServerRequestWrapperFixture;
use Psr\Http\Message\ServerRequestInterface;

class ServerRequestWrapperTest extends WrapperTestCase
{
    use ServerRequestDataProvider;

    protected const WRAPPED_CLASS = ServerRequestInterface::class;
    protected const FIXTURE_CLASS = ServerRequestWrapperFixture::class;
}
