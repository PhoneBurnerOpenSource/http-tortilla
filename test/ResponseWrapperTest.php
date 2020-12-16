<?php

declare(strict_types=1);

namespace PhoneBurnerTest\Http\Message;

use PhoneBurnerTest\Http\Message\DataProvider\ResponseDataProvider;
use PhoneBurnerTest\Http\Message\Fixture\ResponseWrapperFixture;
use Psr\Http\Message\ResponseInterface;

class ResponseWrapperTest extends EvolvingWrapperTestCase
{
    use ResponseDataProvider;

    protected const WRAPPED_CLASS = ResponseInterface::class;
    protected const FIXTURE_CLASS = ResponseWrapperFixture::class;
}
