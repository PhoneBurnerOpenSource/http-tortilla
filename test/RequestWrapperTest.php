<?php

namespace PhoneBurnerTest\Http\Message;

use PhoneBurnerTest\Http\Message\DataProvider\RequestDataProvider;
use PhoneBurnerTest\Http\Message\Fixture\RequestWrapperFixture;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class RequestWrapperTest extends TestCase
{
    use RequestDataProvider;
    use CommonWrapperTests;

    private const WRAPPED_CLASS = RequestInterface::class;
    private const FIXTURE_CLASS = RequestWrapperFixture::class;
}
