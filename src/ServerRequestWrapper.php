<?php

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

    public function getServerParams()
    {
        return $this->getWrapped()->getServerParams();
    }

    public function getCookieParams()
    {
        return $this->getWrapped()->getCookieParams();
    }

    public function withCookieParams(array $cookies)
    {
        return $this->viaFactory($this->getWrapped()->withCookieParams($cookies));
    }

    public function getQueryParams()
    {
        return $this->getWrapped()->getQueryParams();
    }

    public function withQueryParams(array $query)
    {
        return $this->viaFactory($this->getWrapped()->withQueryParams($query));
    }

    public function getUploadedFiles()
    {
        return $this->getWrapped()->getUploadedFiles();
    }

    public function withUploadedFiles(array $uploadedFiles)
    {
        return $this->viaFactory($this->getWrapped()->withUploadedFiles($uploadedFiles));
    }

    public function getParsedBody()
    {
        return $this->getWrapped()->getParsedBody();
    }

    public function withParsedBody($data)
    {
        return $this->viaFactory($this->getWrapped()->withParsedBody($data));
    }

    public function getAttributes()
    {
        return $this->getWrapped()->getAttributes();
    }

    public function getAttribute($name, $default = null)
    {
        return $this->getWrapped()->getAttribute($name, $default);
    }

    public function withAttribute($name, $value)
    {
        return $this->viaFactory($this->getWrapped()->withAttribute($name, $value));
    }

    public function withoutAttribute($name)
    {
        return $this->viaFactory($this->getWrapped()->withoutAttribute($name));
    }
}
