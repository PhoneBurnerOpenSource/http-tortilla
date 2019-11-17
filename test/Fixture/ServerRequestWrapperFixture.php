<?php
namespace PhoneBurnerTest\Http\Message\Fixture;

use PhoneBurner\Http\Message\ServerRequestWrapper;
use Psr\Http\Message\ServerRequestInterface;

class ServerRequestWrapperFixture
{
    use ServerRequestWrapper;

    public function __construct(ServerRequestInterface $request = null, callable $factory = null)
    {
        if (null !== $request) {
            $this->setMessage($request);
        }

        if (null !== $factory) {
            $this->setFactory($factory);
        }
    }
}