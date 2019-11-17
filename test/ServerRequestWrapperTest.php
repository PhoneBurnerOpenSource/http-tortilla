<?php
namespace PhoneBurnerTest\Http\Message;

use PhoneBurnerTest\Http\Message\DataProvider\ServerRequestDataProvider;
use PhoneBurnerTest\Http\Message\Fixture\ServerRequestWrapperFixture;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class ServerRequestWrapperTest extends TestCase
{
    use ServerRequestDataProvider;
    use CommonWrapperTests;

    private CONST WRAPPED_CLASS = ServerRequestInterface::class;
    private CONST FIXTURE_CLASS = ServerRequestWrapperFixture::class;
}
