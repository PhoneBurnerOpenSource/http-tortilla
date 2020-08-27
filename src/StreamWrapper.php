<?php

namespace PhoneBurner\Http\Message;

use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

trait StreamWrapper
{
    private $stream;

    protected function setStream(StreamInterface $stream)
    {
        $this->stream = $stream;
    }

    private function getStream(): StreamInterface
    {
        if (!($this->stream instanceof StreamInterface)) {
            throw new \UnexpectedValueException('must `setUri` before using it');
        }

        return $this->stream;
    }

    public function __toString()
    {
        return $this->getStream()->__toString();
    }

    public function close(): void
    {
        $this->getStream()->close();;
    }

    public function detach()
    {
        return $this->getStream()->detach();
    }

    public function getSize(): ?int
    {
        return $this->getStream()->getSize();
    }

    public function tell(): int
    {
        return $this->getStream()->tell();
    }

    public function eof(): bool
    {
        return $this->getStream()->eof();
    }

    public function isSeekable(): bool
    {
        return $this->getStream()->isSeekable();
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        return $this->getStream()->seek($offset, $whence);
    }

    public function rewind()
    {
        return $this->getStream()->rewind();
    }

    public function isWritable(): bool
    {
        return $this->getStream()->isWritable();
    }

    public function write($string): int
    {
        return $this->getStream()->write($string);
    }

    public function isReadable(): bool
    {
        return $this->getStream()->isReadable();
    }

    public function read($length): string
    {
        return $this->getStream()->read($length);
    }

    public function getContents(): string
    {
        return $this->getStream()->getContents();
    }

    public function getMetadata($key = null)
    {
        return $this->getStream()->getMetadata($key);
    }
}