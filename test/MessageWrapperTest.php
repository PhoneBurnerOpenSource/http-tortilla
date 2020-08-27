<?php

namespace PhoneBurnerTest\Http\Message;

use PhoneBurnerTest\Http\Message\DataProvider\MessageDataProvider;
use PhoneBurnerTest\Http\Message\Fixture\MessageWrapperFixture;
use Psr\Http\Message\MessageInterface;

class MessageWrapperTest extends EvolvingWrapperTestCase
{
    use MessageDataProvider;

    protected const WRAPPED_CLASS = MessageInterface::class;
    protected const FIXTURE_CLASS = MessageWrapperFixture::class;
}
