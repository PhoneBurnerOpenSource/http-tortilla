<?php
namespace PhoneBurner\Http\Message;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

trait RequestWrapper
{
    use MessageWrapper;

    private $message;

    protected function setMessage(RequestInterface $message): void
    {
        $this->message = $message;
    }

    private function getMessage(): RequestInterface
    {
        if (!($this->message instanceof RequestInterface)) {
            throw new \UnexpectedValueException('must `setRequest` before using it');
        }

        return $this->message;
    }

    public function getRequestTarget(): string
    {
        return $this->getMessage()->getRequestTarget();
    }

    public function withRequestTarget($requestTarget): RequestInterface
    {
        return $this->viaFactory($this->getMessage()->withRequestTarget($requestTarget));
    }

    public function getMethod(): string
    {
        return $this->getMessage()->getMethod();
    }

    public function withMethod($method): RequestInterface
    {
        return $this->viaFactory($this->getMessage()->withMethod($method));
    }

    public function getUri(): UriInterface
    {
        return $this->getMessage()->getUri();
    }

    public function withUri(UriInterface $uri, $preserveHost = false): RequestInterface
    {
        return $this->viaFactory($this->getMessage()->withUri($uri, $preserveHost));
    }
}
