<?php

declare(strict_types=1);

namespace PhoneBurner\Http\Message;

use Psr\Http\Message\ServerRequestInterface;

trait ServerRequestWrapper
{
    use RequestWrapper;

    private $wrapped;

    protected function setWrapped(ServerRequestInterface $message): void
    {
        $this->wrapped = $message;
    }

    private function getWrapped(): ServerRequestInterface
    {
        if (!($this->wrapped instanceof ServerRequestInterface)) {
            throw new \UnexpectedValueException('must `setMessage` before using it');
        }

        return $this->wrapped;
    }

    public function getServerParams(): array
    {
        return $this->getWrapped()->getServerParams();
    }

    public function getCookieParams(): array
    {
        return $this->getWrapped()->getCookieParams();
    }

    public function withCookieParams(array $cookies): ServerRequestInterface
    {
        return $this->viaFactory($this->getWrapped()->withCookieParams($cookies));
    }

    public function getQueryParams(): array
    {
        return $this->getWrapped()->getQueryParams();
    }

    public function withQueryParams(array $query): ServerRequestInterface
    {
        return $this->viaFactory($this->getWrapped()->withQueryParams($query));
    }

    public function getUploadedFiles(): array
    {
        return $this->getWrapped()->getUploadedFiles();
    }

    public function withUploadedFiles(array $uploadedFiles): ServerRequestInterface
    {
        return $this->viaFactory($this->getWrapped()->withUploadedFiles($uploadedFiles));
    }

    public function getParsedBody()
    {
        return $this->getWrapped()->getParsedBody();
    }

    public function withParsedBody($data): ServerRequestInterface
    {
        return $this->viaFactory($this->getWrapped()->withParsedBody($data));
    }

    public function getAttributes(): array
    {
        return $this->getWrapped()->getAttributes();
    }

    public function getAttribute($name, $default = null)
    {
        return $this->getWrapped()->getAttribute($name, $default);
    }

    public function withAttribute($name, $value): ServerRequestInterface
    {
        return $this->viaFactory($this->getWrapped()->withAttribute($name, $value));
    }

    public function withoutAttribute($name): ServerRequestInterface
    {
        return $this->viaFactory($this->getWrapped()->withoutAttribute($name));
    }
}
