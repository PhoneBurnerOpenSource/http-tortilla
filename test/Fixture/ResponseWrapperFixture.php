<?php

namespace PhoneBurnerTest\Http\Message\Fixture;

use PhoneBurner\Http\Message\ResponseWrapper;
use Psr\Http\Message\ResponseInterface;

class ResponseWrapperFixture implements ResponseInterface
{
    use ResponseWrapper;

    public function __construct(ResponseInterface $response = null, callable $factory = null)
    {
        if (null !== $response) {
            $this->setWrapped($response);
        }

        if (null !== $factory) {
            $this->setFactory($factory);
        }
    }
}
