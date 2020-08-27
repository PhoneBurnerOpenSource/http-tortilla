<?php

namespace PhoneBurnerTest\Http\Message\Fixture;

use PhoneBurner\Http\Message\UploadedFileWrapper;
use Psr\Http\Message\UploadedFileInterface;

class UploadedFileWrapperFixture implements UploadedFileInterface
{
    use UploadedFileWrapper;

    public function __construct(UploadedFileInterface $file = null)
    {
        if (null !== $file) {
            $this->setWrapped($file);
        }
    }
}