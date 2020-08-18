<?php

namespace PhoneBurnerTest\Http\Message\Fixture;

use PhoneBurner\Http\Message\UploadWrapper;
use Psr\Http\Message\UploadedFileInterface;

class UploadedFileFixture implements UploadedFileInterface
{
    use UploadWrapper;

    public function __construct(UploadedFileInterface $file = null)
    {
        if (null !== $file) {
            $this->setUploadedFile($file);
        }
    }
}