<?php
declare(strict_types=1);

namespace PhoneBurnerTest\Http\Message;

use PhoneBurnerTest\Http\Message\DataProvider\RequestDataProvider;
use PhoneBurnerTest\Http\Message\Fixture\RequestWrapperFixture;
use Psr\Http\Message\RequestInterface;

class RequestWrapperTest extends EvolvingWrapperTestCase
{
    use RequestDataProvider;

    protected const WRAPPED_CLASS = RequestInterface::class;
    protected const FIXTURE_CLASS = RequestWrapperFixture::class;
}
