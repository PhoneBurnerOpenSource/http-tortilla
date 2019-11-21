<?php

namespace PhoneBurnerTest\Http\Message\Fixture;

use PhoneBurner\Http\Message\MessageWrapper;
use Psr\Http\Message\MessageInterface;

class MessageWrapperFixture
{
    use MessageWrapper;

    public function __construct(MessageInterface $message = null, callable $factory = null)
    {
        if (null !== $message) {
            $this->setMessage($message);
        }

        if (null !== $factory) {
            $this->setFactory($factory);
        }
    }
}
