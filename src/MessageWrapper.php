<?php
declare(strict_types=1);

namespace PhoneBurner\Http\Message;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

trait MessageWrapper
{
    private $wrapped;
    private $factory;

    protected function setFactory(callable $factory): void
    {
        $this->factory = $factory;
    }

    private function viaFactory(MessageInterface $message): MessageInterface
    {
        if (!$this->factory) {
            return $message;
        }

        return call_user_func($this->factory, $message);
    }

    protected function setWrapped(MessageInterface $message): void
    {
        $this->wrapped = $message;
    }

    private function getWrapped(): MessageInterface
    {
        if (!($this->wrapped instanceof MessageInterface)) {
            throw new \UnexpectedValueException('must `setMessage` before using it');
        }

        return $this->wrapped;
    }

    public function getProtocolVersion(): string
    {
        return $this->getWrapped()->getProtocolVersion();
    }

    public function withProtocolVersion($version): MessageInterface
    {
        return $this->viaFactory($this->getWrapped()->withProtocolVersion($version));
    }

    public function getHeaders(): array
    {
        return $this->getWrapped()->getHeaders();
    }

    public function hasHeader($name): bool
    {
        return $this->getWrapped()->hasHeader($name);
    }

    public function getHeader($name): array
    {
        return $this->getWrapped()->getHeader($name);
    }

    public function getHeaderLine($name): string
    {
        return $this->getWrapped()->getHeaderLine($name);
    }

    public function withHeader($name, $value): MessageInterface
    {
        return $this->viaFactory($this->getWrapped()->withHeader($name, $value));
    }

    public function withAddedHeader($name, $value): MessageInterface
    {
        return $this->viaFactory($this->getWrapped()->withAddedHeader($name, $value));
    }

    public function withoutHeader($name): MessageInterface
    {
        return $this->viaFactory($this->getWrapped()->withoutHeader($name));
    }

    public function getBody(): StreamInterface
    {
        return $this->getWrapped()->getBody();
    }

    public function withBody(StreamInterface $body): MessageInterface
    {
        return $this->viaFactory($this->getWrapped()->withBody($body));
    }
}
