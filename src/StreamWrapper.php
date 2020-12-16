<?php

declare(strict_types=1);

namespace PhoneBurner\Http\Message;

use Psr\Http\Message\StreamInterface;

trait StreamWrapper
{
    private $wrapped;

    protected function setWrapped(StreamInterface $stream): void
    {
        $this->wrapped = $stream;
    }

    private function getWrapped(): StreamInterface
    {
        if (!($this->wrapped instanceof StreamInterface)) {
            throw new \UnexpectedValueException('must `setUri` before using it');
        }

        return $this->wrapped;
    }

    public function __toString(): string
    {
        return $this->getWrapped()->__toString();
    }

    public function close(): void
    {
        $this->getWrapped()->close();
    }

    public function detach()
    {
        return $this->getWrapped()->detach();
    }

    public function getSize(): ?int
    {
        return $this->getWrapped()->getSize();
    }

    public function tell(): int
    {
        return $this->getWrapped()->tell();
    }

    public function eof(): bool
    {
        return $this->getWrapped()->eof();
    }

    public function isSeekable(): bool
    {
        return $this->getWrapped()->isSeekable();
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        return $this->getWrapped()->seek($offset, $whence);
    }

    public function rewind()
    {
        return $this->getWrapped()->rewind();
    }

    public function isWritable(): bool
    {
        return $this->getWrapped()->isWritable();
    }

    public function write($string): int
    {
        return $this->getWrapped()->write($string);
    }

    public function isReadable(): bool
    {
        return $this->getWrapped()->isReadable();
    }

    public function read($length): string
    {
        return $this->getWrapped()->read($length);
    }

    public function getContents(): string
    {
        return $this->getWrapped()->getContents();
    }

    public function getMetadata($key = null)
    {
        return $this->getWrapped()->getMetadata($key);
    }
}
