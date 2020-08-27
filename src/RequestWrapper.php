<?php

namespace PhoneBurner\Http\Message;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

trait RequestWrapper
{
    use MessageWrapper;

    private $wrapped;

    protected function setWrapped(RequestInterface $message): void
    {
        $this->wrapped = $message;
    }

    private function getWrapped(): RequestInterface
    {
        if (!($this->wrapped instanceof RequestInterface)) {
            throw new \UnexpectedValueException('must `setRequest` before using it');
        }

        return $this->wrapped;
    }

    public function getRequestTarget(): string
    {
        return $this->getWrapped()->getRequestTarget();
    }

    public function withRequestTarget($requestTarget): RequestInterface
    {
        return $this->viaFactory($this->getWrapped()->withRequestTarget($requestTarget));
    }

    public function getMethod(): string
    {
        return $this->getWrapped()->getMethod();
    }

    public function withMethod($method): RequestInterface
    {
        return $this->viaFactory($this->getWrapped()->withMethod($method));
    }

    public function getUri(): UriInterface
    {
        return $this->getWrapped()->getUri();
    }

    public function withUri(UriInterface $uri, $preserveHost = false): RequestInterface
    {
        return $this->viaFactory($this->getWrapped()->withUri($uri, $preserveHost));
    }
}
