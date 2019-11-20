<?php

namespace PhoneBurner\Http\Message;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

trait MessageWrapper
{
    private $message;
    private $messageFactory;

    protected function setFactory(callable $factory)
    {
        $this->messageFactory = $factory;
    }

    private function viaFactory(MessageInterface $message)
    {
        if (!$this->messageFactory) {
            return $message;
        }

        return call_user_func($this->messageFactory, $message);
    }

    protected function setMessage(MessageInterface $message)
    {
        $this->message = $message;
    }

    private function getMessage(): MessageInterface
    {
        if (!($this->message instanceof MessageInterface)) {
            throw new \UnexpectedValueException('must `setMessage` before using it');
        }

        return $this->message;
    }

    public function getProtocolVersion(): string
    {
        return $this->getMessage()->getProtocolVersion();
    }

    public function withProtocolVersion(string $version): MessageInterface
    {
        return $this->viaFactory($this->getMessage()->withProtocolVersion($version));
    }

    public function getHeaders(): array
    {
        return $this->getMessage()->getHeaders();
    }

    public function hasHeader(string $name): bool
    {
        return $this->getMessage()->hasHeader($name);
    }

    public function getHeader(string $name): array
    {
        return $this->getMessage()->getHeader($name);
    }

    public function getHeaderLine(string $name): string
    {
        return $this->getMessage()->getHeaderLine($name);
    }

    public function withHeader(string $name, $value): MessageInterface
    {
        return $this->viaFactory($this->getMessage()->withHeader($name, $value));
    }

    public function withAddedHeader(string $name, $value): MessageInterface
    {
        return $this->viaFactory($this->getMessage()->withAddedHeader($name, $value));
    }

    public function withoutHeader(string $name): MessageInterface
    {
        return $this->viaFactory($this->getMessage()->withoutHeader($name));
    }

    public function getBody(): StreamInterface
    {
        return $this->getMessage()->getBody();
    }

    public function withBody(StreamInterface $body): MessageInterface
    {
        return $this->viaFactory($this->getMessage()->withBody($body));
    }
}
