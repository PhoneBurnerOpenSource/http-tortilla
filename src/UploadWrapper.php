<?php

namespace PhoneBurner\Http\Message;

use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;

trait UploadWrapper
{
    private $file;

    private function setUploadedFile(UploadedFileInterface $file)
    {
        $this->file = $file;
    }

    private function getUploadedFile(): UploadedFileInterface
    {
        if (!($this->file instanceof UploadedFileInterface)) {
            throw new \UnexpectedValueException('must `setUploadedFile` before using it');
        }

        return $this->file;
    }

    public function getStream(): StreamInterface
    {
        return $this->getUploadedFile()->getStream();
    }

    public function moveTo(string $targetPath): void
    {
        $this->getUploadedFile()->moveTo($targetPath);
    }

    public function getSize(): ?int
    {
        return $this->getUploadedFile()->getSize();
    }

    public function getError(): int
    {
        return $this->getUploadedFile()->getError();
    }

    public function getClientFilename(): ?string
    {
        return $this->getUploadedFile()->getClientFilename();
    }

    public function getClientMediaType(): ?string
    {
        return $this->getUploadedFile()->getClientMediaType();
    }
}