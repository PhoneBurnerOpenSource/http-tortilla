<?php
declare(strict_types=1);

namespace PhoneBurnerTest\Http\Message\Fixture;

use PhoneBurner\Http\Message\ServerRequestWrapper;
use Psr\Http\Message\ServerRequestInterface;

class ServerRequestWrapperFixture implements ServerRequestInterface
{
    use ServerRequestWrapper;

    public function __construct(ServerRequestInterface $request = null, callable $factory = null)
    {
        if (null !== $request) {
            $this->setWrapped($request);
        }

        if (null !== $factory) {
            $this->setFactory($factory);
        }
    }
}
