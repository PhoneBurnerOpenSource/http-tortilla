<?php

declare(strict_types=1);

namespace PhoneBurner\Http\Message;

use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;

trait UploadedFileWrapper
{
    private $wrapped;

    private function setWrapped(UploadedFileInterface $file): void
    {
        $this->wrapped = $file;
    }

    private function getWrapped(): UploadedFileInterface
    {
        if (!($this->wrapped instanceof UploadedFileInterface)) {
            throw new \UnexpectedValueException('must `setUploadedFile` before using it');
        }

        return $this->wrapped;
    }

    public function getStream(): StreamInterface
    {
        return $this->getWrapped()->getStream();
    }

    public function moveTo($targetPath): void
    {
        $this->getWrapped()->moveTo($targetPath);
    }

    public function getSize(): ?int
    {
        return $this->getWrapped()->getSize();
    }

    public function getError(): int
    {
        return $this->getWrapped()->getError();
    }

    public function getClientFilename(): ?string
    {
        return $this->getWrapped()->getClientFilename();
    }

    public function getClientMediaType(): ?string
    {
        return $this->getWrapped()->getClientMediaType();
    }
}
