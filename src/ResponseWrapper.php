<?php

namespace PhoneBurner\Http\Message;

use Psr\Http\Message\ResponseInterface;

trait ResponseWrapper
{
    use MessageWrapper;

    private $wrapped;

    protected function setWrapped(ResponseInterface $message): void
    {
        $this->wrapped = $message;
    }

    private function getWrapped(): ResponseInterface
    {
        if (!($this->wrapped instanceof ResponseInterface)) {
            throw new \UnexpectedValueException('must `setRequest` before using it');
        }

        return $this->wrapped;
    }

    public function getStatusCode(): int
    {
        return $this->getWrapped()->getStatusCode();
    }

    public function withStatus($code, $reasonPhrase = '')
    {
        return $this->viaFactory($this->getWrapped()->withStatus($code, $reasonPhrase));
    }

    public function getReasonPhrase(): string
    {
        return $this->getWrapped()->getReasonPhrase();
    }
}
