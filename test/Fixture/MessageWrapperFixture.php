<?php
declare(strict_types=1);

namespace PhoneBurnerTest\Http\Message\Fixture;

use PhoneBurner\Http\Message\MessageWrapper;
use Psr\Http\Message\MessageInterface;

class MessageWrapperFixture implements MessageInterface
{
    use MessageWrapper;

    public function __construct(MessageInterface $message = null, callable $factory = null)
    {
        if (null !== $message) {
            $this->setWrapped($message);
        }

        if (null !== $factory) {
            $this->setFactory($factory);
        }
    }
}
