<?php

namespace PhoneBurner\Http\Message;

use Psr\Http\Message\ResponseInterface;

trait ResponseWrapper
{
    use MessageWrapper;

    private $message;

    protected function setMessage(ResponseInterface $message): void
    {
        $this->message = $message;
    }

    private function getMessage(): ResponseInterface
    {
        if (!($this->message instanceof ResponseInterface)) {
            throw new \UnexpectedValueException('must `setRequest` before using it');
        }

        return $this->message;
    }

    public function getStatusCode(): int
    {
        return $this->getMessage()->getStatusCode();
    }

    public function withStatus(int $code, string $reasonPhrase = '')
    {
        return $this->viaFactory($this->getMessage()->withStatus($code, $reasonPhrase));
    }

    public function getReasonPhrase(): string
    {
        return $this->getMessage()->getReasonPhrase();
    }
}
