<?php

namespace PhoneBurnerTest\Http\Message\Fixture;

use PhoneBurner\Http\Message\UriWrapper;
use Psr\Http\Message\UriInterface;

class UriWrapperFixture implements UriInterface
{
    use UriWrapper;

    public function __construct(UriInterface $uri = null, callable $factory = null)
    {
        if (null !== $uri) {
            $this->setWrapped($uri);
        }

        if (null !== $factory) {
            $this->setFactory($factory);
        }
    }
}
