<?php

declare(strict_types=1);

namespace PhoneBurnerTest\Http\Message\Fixture;

use PhoneBurner\Http\Message\RequestWrapper;
use Psr\Http\Message\RequestInterface;

class RequestWrapperFixture implements RequestInterface
{
    use RequestWrapper;

    public function __construct(RequestInterface $request = null, callable $factory = null)
    {
        if (null !== $request) {
            $this->setWrapped($request);
        }

        if (null !== $factory) {
            $this->setFactory($factory);
        }
    }
}
