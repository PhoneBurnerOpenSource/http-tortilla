<?php
namespace PhoneBurnerTest\Http\Message;

use PhoneBurnerTest\Http\Message\DataProvider\ResponseDataProvider;
use PhoneBurnerTest\Http\Message\Fixture\ResponseWrapperFixture;
use Psr\Http\Message\ResponseInterface;
use PHPUnit\Framework\TestCase;

class ResponseWrapperTest extends TestCase
{
    use ResponseDataProvider;
    use CommonWrapperTests;

    private CONST WRAPPED_CLASS = ResponseInterface::class;
    private CONST FIXTURE_CLASS = ResponseWrapperFixture::class;
}
